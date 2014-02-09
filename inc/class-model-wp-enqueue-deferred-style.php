<?php
if(!class_exists('Model_WP_Enqueue_Deferred_Style')){
  class Model_WP_Enqueue_Deferred_Style{

    public $registered = array();
    public $done = array();
    public $queue = array();

    private static function is_dependency($handle){
      global $wp_styles;
      foreach($wp_styles->registered as $style => $data){
        if(in_array($handle, $wp_styles->registered[$style]->deps)){
          return true;
        }
      }
      return false;
    }

    public function register_deferred_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all'){
      global $wp_styles;
      if(self::is_dependency($handle)){
        return false;
      }
      if(empty($src)){
        if(array_key_exists($handle, $wp_styles->registered)){
          $this->registered[$handle] = array(
            'handle' => $handle,
            'src' => $wp_styles->registered[$handle]['src'],
            'deps' => $wp_styles->registered[$handle]['deps'],
            'ver' => $wp_styles->registered[$handle]['ver'],
            'media' => $wp_styles->registered[$handle]['media']
          );

        }

      }else{
        if(!array_key_exists($handle, $this->registered)){
          $this->registered[$handle] = array(
            'handle' => $handle,
            'src' => $src,
            'deps' => $deps,
            'ver' => $ver,
            'media' => $media
          );
          wp_register_style($handle, $src, $deps, $ver, $media);
        }
      }
    }

    public function enqueue_deferred_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all'){
      if(!array_key_exists($handle, $this->registered)){
        $this->register_deferred_style($handle, $src, $deps, $ver, $media);
      }

      $this->add_to_queue($handle);
    }

    public function do_defer(){
      global $wp_styles;

      foreach($wp_styles->queue as $style){
        if(array_key_exists($style, $this->registered)){
          $this->add_to_queue($style);
        }
      }

      foreach($this->queue as $style){
        $wp_styles->queue = array_merge(array_diff($wp_styles->queue, array($style)));
        $wp_styles->done[] = $style;
      }
    }

    public function do_enqueue(){
      global $wp_styles;
      foreach($this->queue as $style){
        $wp_styles->done = array_diff($wp_styles->done, array($style));
        $wp_styles->queue[] = $style;
      }
    }

    private function add_to_queue($handle){
      if(!in_array($handle, $this->queue)){
        $this->queue[] = $handle;
      }
    }

  }
}
