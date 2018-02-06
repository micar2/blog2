<ul class="sidebar-menu" data-widget="tree">
    <li class="header">@lang('admin.layout.header')</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i>Ver todos los posts</a></li>
            <li><a href="#"><i class="fa fa-pencil"></i>Crear un post</a></li>
        </ul>
    </li>
</ul>
