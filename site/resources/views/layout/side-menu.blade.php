
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-toggleable-sm navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav list-group">
                    <li class="list-group-item">
                        <a href="/"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/people" data-toggle="collapse" data-target="#clients"><i class="fa fa-fw fa-users"></i> Clientes <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="clients" class="list-group collapse in">
                            <li class="list-group-item">
                                <a href="{{ action('PeopleController@create', ['type_text' => 'natural']) }}"><i class="fa fa-fw fa-plus-square"></i> Persona Natural</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ action('PeopleController@create', ['type_text' => 'jurídica']) }}"><i class="fa fa-fw fa-plus-square"></i> Persona Jurídica</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/people/all"><i class="fa fa-fw fa-list-ul"></i> Todos</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/people/natural"><i class="fa fa-fw fa-list-ul"></i> Personas Naturales</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/people/juridica"><i class="fa fa-fw fa-list-ul"></i> Personas Jurídicas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="list-group collapse">
                            <li class="list-group-item">
                                <a href="javascript:;">Dropdown Item</a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li class="list-group-item hidden">
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->