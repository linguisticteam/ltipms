<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Videos',
            'view' => 'videos/retrieve',
            'type' => 'team',
//            'videos' => $this->videos_model->get_videos_inprogress()->result(),
//            'translators' => $this->translators_model->get_all_translators()->result(),
        );
        $this->load->view('controlpanel',$data);
    }

    public function transcribing()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);
        
        $data = array(
            'title' => 'Videos open for transcription',
            'type' => 'team',
            'view' => 'videos/transcribing',
            'videos_inprogress' => $this->medias_model->get_videos_transcribing($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function register_function()
    {
        $media_id = $this->uri->segment(5);
        $function = $this->uri->segment(6);
        $stage = $this->uri->segment(7);

        $shortname = $this->uri->segment(2);
        
        $this->medias_model->register_function($media_id, $function);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));
        
        redirect('languages/'.$shortname.'/videos/'.$stage);
    }
    
    public function register_member_function()
    { 
        $media_id = $this->uri->segment(5);
        $function = $this->uri->segment(6);
        $member_id = $this->uri->segment(7);

        $shortname = $this->uri->segment(2);
       
        // I don't know why the method has been called twice.
        // The second time it has a value of 'js'
        if ($member_id!='js')        
            $this->medias_model->register_function($media_id, $function, $member_id);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));
        
        $data = array(
            'title' => 'Edit video',
            'type' => 'team',
            'view' => 'videos/edit'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function unregister_member_function()
    {
        $media_id = $this->uri->segment(5);
        $function = $this->uri->segment(6);
        $member_id = $this->uri->segment(7);

        $shortname = $this->uri->segment(2);
        
        $this->medias_model->unregister_function($media_id, $function, $member_id);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));
        
        $data = array(
            'title' => 'Edit video',
            'type' => 'team',
            'view' => 'videos/edit'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function go_to_stage()
    {
        $media_id = $this->uri->segment(5);
        $state = $this->uri->segment(6);        
        $inc = $this->uri->segment(7);        

        $shortname = $this->uri->segment(2);
        
        $this->medias_model->go_to_stage($media_id, $state, $inc);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));
        
        $data = array(
            'title' => 'Edit video',
            'type' => 'team',
            'view' => 'videos/edit'
        );

        $this->load->view('controlpanel',$data);
    }
    
    public function release_video()
    {
        $media_id = $this->uri->segment(5);   

        $shortname = $this->uri->segment(2);
        
        $this->medias_model->go_to_stage($media_id, STATE_FINAL_REVIEW_COMPLETED, 1);
        
        $this->medias_model->release_translations($media_id);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));
        
        $data = array(
            'title' => 'Edit video',
            'type' => 'team',
            'view' => 'videos/edit'
        );

        $this->load->view('controlpanel',$data);
    }

    public function open_for_translation()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos open for translation',
            'type' => 'team',
            'view' => 'videos/open_for_translation',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_open_for_translation($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function in_progress()
    {        
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos in progress',
            'type' => 'team',
            'view' => 'videos/in_progress',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_in_progress($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function ready_to_post()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos ready to post',
            'type' => 'team',
            'view' => 'videos/ready_to_post',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_ready_to_post($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function posted()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos posted',
            'type' => 'team',
            'view' => 'videos/posted',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_posted($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function repository()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos in repository',
            'type' => 'team',
            'view' => 'videos/repository',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_repository($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function on_hold()
    {
        $shortname = $this->uri->segment(2);

        $team = $this->language_teams_model->get_language_team_by_shortname($shortname);
        
        $this->session->set_userdata('teamdata', $team);

        $data = array(
            'title' => 'Videos on hold',
            'type' => 'team',
            'view' => 'videos/on_hold',
            'team' => $this->language_teams_model->get_language_team_by_shortname($shortname),
            'videos_inprogress' => $this->medias_model->get_videos_on_hold($team->id),
        );
        $this->load->view('controlpanel',$data);
    }

    public function add()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('title','TITLE','trim|required|max_length[255]');
        $this->form_validation->set_rules('description','DESCRIPTION','trim|required|max_length[255]');
        $this->form_validation->set_message('is_natural_no_zero', 'You have to choose a category!');
        $this->form_validation->set_rules('category','CATEGORY','trim|required|is_natural_no_zero');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('title','description',
                                   'originator','producer','original_language_id','project_language_id',
                                   'state','type','subtype','category','parent_id','priority',
                                   'working_location','original_location','publish_location','repo_storage_location','repo_distribution_location',
                                   'duration','date_added','date_finished',
                                   'forum_thread','comments','notes'),$this->input->post());
            $this->medias_model->insert_video($data);
        endif;

        $data = array(
            'title' => 'Home',
            'type' => 'team',
            'view' => 'videos/add'
        );

        $this->load->view('controlpanel',$data);
    }

    public function edit()
    {
        $shortname = $this->uri->segment(2);

        $this->session->set_userdata('teamdata', $this->language_teams_model->get_language_team_by_shortname($shortname));

        $this->form_validation->set_rules('title','TITLE','trim|required|max_length[255]');
        $this->form_validation->set_rules('description','DESCRIPTION','trim|required|max_length[255]');
        $this->form_validation->set_message('is_natural_no_zero', 'You have to choose a category!');
        $this->form_validation->set_rules('category','CATEGORY','trim|required|is_natural_no_zero');

        if ($this->form_validation->run()==TRUE):
            $data = elements(array('title','description',
                                   'originator','producer',
                                   'category','priority',
                                   'working_location','original_location','publish_location','repo_storage_location','repo_distribution_location',
                                   'duration','date_added','date_finished',
                                   'forum_thread','comments','notes'),$this->input->post());
            $this->medias_model->update_video($data,array('id'=>$this->input->post('id')));
        endif;

        $data = array(
            'title' => 'Edit video',
            'type' => 'team',
            'view' => 'videos/edit'
        );

        $this->load->view('controlpanel',$data);
    }
}