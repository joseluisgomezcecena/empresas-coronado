<?php

class Dashboards extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->model('Inventory_model');
        $this->load->model('Categories_model');
    }

    public function index()
    {
        $data['active'] = 'home';
        $data['title'] = 'Panel de control.';
        $data['controller'] = $this;

        // Quick Stats
        $data['total_products'] = $this->get_total_products();
        $data['low_stock_count'] = $this->get_low_stock_count();
        $data['total_inventory_value'] = $this->get_total_inventory_value();
        $data['movements_count'] = $this->get_recent_movements_count();
        $data['total_sales'] = $this->get_total_sales(); 

        // Sales Data
        $data['monthly_sales'] = $this->get_monthly_sales(); // New
        $data['sales_chart_data'] = $this->get_sales_chart_data(); // New

        // Charts Data
        $data['inventory_movements'] = $this->get_inventory_movements_chart_data();
        $data['category_distribution'] = $this->get_category_distribution();

        // Tables Data
        $data['top_products'] = $this->get_top_moved_products();
        $data['recent_movements'] = $this->get_recent_movements();

        // Additional Stats
        $data['out_of_stock'] = $this->get_out_of_stock_count();
        $data['brand_stats'] = $this->get_brand_statistics();

        
    
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav', $data);
        $this->load->view('_templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('_templates/footer', $data);
        
    }

    public function main_image($property)
    {
        $data = $this->Property_model->get_main_image($property);
        return $data['url'];
    }

    public function get_custom_fields($property_id)
    {
        $custom_fields = $this->Property_model->get_custom_fields($property_id);
        return $custom_fields;
    }

    private function get_total_products()
    {
        return $this->db->count_all('products');
    }

    private function get_low_stock_count()
    {
        $this->db->select('p.*, 
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END), 0) as current_stock');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->group_by('p.id');
        $this->db->having('current_stock <= 5'); // Define your low stock threshold
        return $this->db->count_all_results();
    }

    private function get_total_inventory_value()
    {
        $this->db->select('SUM(p.purchase_price * 
            COALESCE((SELECT SUM(CASE WHEN movement_type = "entrada" THEN quantity ELSE -quantity END) 
            FROM inventory_movements WHERE product_id = p.id), 0)) as total_value');
        $this->db->from('products p');
        $query = $this->db->get();
        $result = $query->row();
        return $result->total_value ?? 0;
    }

    private function get_recent_movements_count()
    {
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        return $this->db->count_all_results('inventory_movements');
    }

    private function get_inventory_movements_chart_data()
    {
        $this->db->select('DATE(created_at) as date, 
            SUM(CASE WHEN movement_type = "entrada" THEN quantity ELSE 0 END) as entradas,
            SUM(CASE WHEN movement_type = "salida" THEN quantity ELSE 0 END) as salidas');
        $this->db->from('inventory_movements');
        $this->db->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    private function get_category_distribution()
    {
        $this->db->select('c.category_name, COUNT(pc.product_id) as product_count');
        $this->db->from('category c');
        $this->db->join('product_categories pc', 'c.category_id = pc.category_id', 'left');
        $this->db->group_by('c.category_id');
        return $this->db->get()->result_array();
    }

    private function get_top_moved_products($limit = 10)
    {
        $this->db->select('p.product_name, p.part_number, 
            COUNT(im.id) as movements,
            COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END), 0) as current_stock');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id');
        $this->db->group_by('p.id');
        $this->db->order_by('movements', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    private function get_recent_movements($limit = 10)
    {
        $this->db->select('im.*, p.product_name');
        $this->db->from('inventory_movements im');
        $this->db->join('products p', 'p.id = im.product_id');
        $this->db->order_by('im.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    private function get_out_of_stock_count()
    {
        $this->db->select('p.id');
        $this->db->from('products p');
        $this->db->join('inventory_movements im', 'p.id = im.product_id', 'left');
        $this->db->group_by('p.id');
        $this->db->having('COALESCE(SUM(CASE WHEN im.movement_type = "entrada" THEN im.quantity ELSE -im.quantity END), 0) <= 0');
        return $this->db->count_all_results();
    }

    private function get_brand_statistics()
    {
        $this->db->select('b.name as brand_name, COUNT(p.id) as product_count');
        $this->db->from('brands b');
        $this->db->join('products p', 'p.car_brand = b.id');
        $this->db->group_by('b.id');
        $this->db->order_by('product_count', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }

    private function get_total_sales()
    {
        $this->db->where('movement_type', 'salida');
        $this->db->where('reason', 'venta');
        return $this->db->count_all_results('inventory_movements');
    }

    private function get_monthly_sales()
    {
        $this->db->select("
            DATE_FORMAT(im.created_at, '%Y-%m') as month,
            DATE_FORMAT(im.created_at, '%M %Y') as month_name,
            COUNT(*) as total_sales,
            SUM(im.quantity) as total_items,
            SUM(p.sale_price * im.quantity) as total_amount
        ");
        $this->db->from('inventory_movements im');
        $this->db->join('products p', 'p.id = im.product_id');
        $this->db->where('im.movement_type', 'salida');
        $this->db->where('im.reason', 'venta');
        $this->db->where('im.created_at >= DATE_SUB(NOW(), INTERVAL 12 MONTH)');
        $this->db->group_by('month');
        $this->db->order_by('month', 'DESC');
        return $this->db->get()->result_array();
    }

    private function get_sales_chart_data()
    {
        $this->db->select("
            DATE_FORMAT(im.created_at, '%Y-%m-%d') as date,
            COUNT(*) as sales_count,
            SUM(im.quantity) as items_sold,
            SUM(p.sale_price * im.quantity) as revenue
        ");
        $this->db->from('inventory_movements im');
        $this->db->join('products p', 'p.id = im.product_id');
        $this->db->where('im.movement_type', 'salida');
        $this->db->where('im.reason', 'venta');
        $this->db->where('im.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)');
        $this->db->group_by('date');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }
    
}