<section class="page-header">
    <div class="row">
        <div class="col-md-6">
            <h1>{{ the_title() }}</h1>
            {!! the_content() !!}
        </div>
        <div class="col-md-6">
            {!! do_shortcode('[ajax_load_more_filters id="tips" target="tips_load_more" transition_container="false"]') !!}
        </div>
</section>
<section class="page-content">
        {{-- @foreach ($posts as $post)
        @php setup_postdata($post) @endphp
        @include('partials.post-item', [
            'post_classes' => '',
            'format' => 'advice',
            'showExcerpt' => false,
          ])
          @if($loop->iteration == 4)
            <div class="clearfix"></div>
          @endif
        @endforeach
        @php wp_reset_postdata() @endphp --}}
        @php 
        $args = array(
            'id' => 'tips_load_more',
            'target' => 'tips',
            'filters' => 'true',
            'post_type' => 'post',
            'posts_per_page' => '6',
            'category' => 'advice-tips',
            'button_label' => 'Show More Posts',
            'button_loading_label' => 'Loading...',
            'loading_style' => "infinite ring",
            'scroll' => 'true',
            'transition_container' => 'false',
            'placeholder' => 'true',
            'theme_repeater' => 'post-tips.php'
        );	
        if(function_exists('alm_render')){
            alm_render($args);
        }
        @endphp
</section>