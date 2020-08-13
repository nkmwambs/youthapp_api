<?php

require APPPATH . 'libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

//END point uri: http://localhost/youthapp_api/index.php/api/goals

class Themes extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('theme_model');
    }


    /**
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
     * @return Response
     * @param: $id Integer
     */
    public function themesdata_get($id = 0)
    {
        $data = $this->theme_model->get_themes($id);

        $this->response($data, REST_Controller::HTTP_OK);
    }
    /**
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
     * @param: $id Integer
     * @return Response
     */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('theme', $input);

        $this->response(['themes created successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
     * @return Response
     * @param: $id Integer
     */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('theme', $input, array('theme_id' => $id));

        $this->response(['theme updated successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * @author: Livingstone Onduso
     * @Date: 5/5/2020
     * @return Response
     * @param: $id Integer
     */
    public function index_delete($id)
    {
        $this->db->delete('theme', array('id' => $id));

        $this->response(['themes deleted successfully.'], REST_Controller::HTTP_OK);
    }
}
