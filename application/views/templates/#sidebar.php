<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav bg-primary text-white" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php
                                $role_id = $this->session->userdata('role_id') ;
                                $queryMenu = "SELECT user_menu.id, menu FROM user_menu JOIN user_access_menu ON user_menu.id = user_access_menu.menu_id WHERE user_access_menu.role_id = $role_id ORDER BY user_access_menu.menu_id ASC";
                                $menu = $this->db->query($queryMenu)->result_array();
                                // var_dump($menu);die;
                                foreach ($menu as $m) :
                                    $menuId = $m['id'];                             
                                    echo "<div class='sb-sidenav-menu-heading'>" . $m['menu'] . "</div>";

                                    // var_dump($menuId);die;
                                    $querySubMenu = "SELECT * FROM user_sub_menu WHERE user_sub_menu.menu_id = $menuId AND is_active = 1";
                                    $subMenu = $this->db->query($querySubMenu)->result_array();
                                    foreach($subMenu as $sm) {
                                        if($title == $sm['title'] ) : 
                                            echo '<a class="nav-link text-primary bg-white" href="'. base_url( $sm['url'] ) . '">';
                                            echo '<div class="sb-nav-link-icon"><i class="' . $sm['icon'] . '"></i></div>';
                                            echo $sm['title'] .'</a>';
                                        else :
                            ?>
                                        <a class="nav-link text-light" href="<?= base_url( $sm['url'] ) ?>">
                                            <div class="sb-nav-link-icon"><i class="<?= $sm['icon'] ?>"></i></div>
                                            <?= $sm['title'] ?>
                                        </a>
                            <?php
                                        endif;
                                    }
                                    echo '<hr class="sidebar-divider my-0">';
                                endforeach
                            ?>
                            <hr class="dropdown-divider" />
                            <a class="nav-link text-white" href="<?= base_url('auth/logout')?> ">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer bg-primary">
                        <div class="small">Logged in as:</div>
                        <?= $user['name'] ?>
                    </div>
                </nav>
            </div>