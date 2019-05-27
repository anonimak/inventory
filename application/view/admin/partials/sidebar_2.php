<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <!--
            Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
        -->
            <div class="logo">
                <div class="logo-image-big">
                <img src="<?= BASEURL?>asset/img/logo.png" alt="" srcset="" style="width:300px">
                </div>
            </div>
            <div class="sidebar-wrapper">
            <ul class="nav">
                <li <?= ($data['menu'] == 'home')?' class="active "':'';?> >
                <a href="<?= BASEURL?>Dashboards">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
                <li <?= ($data['menu'] == 'list_part_work')?' class="active "':'';?>>
                <a href="<?= BASEURL?>List_part_work">
                    <i class="nc-icon nc-box-2"></i>
                    <p>List Part</p>
                </a>
                </li>
                </li>
                <li <?= ($data['menu'] == 'request_part')?' class="active "':'';?>>
                <a href="<?= BASEURL ?>Request_part">
                    <i class="nc-icon nc-box"></i>
                    <p>Request Part</p>
                </a>
                </li>
                <li <?= ($data['menu'] == 'pengambilan_part')?' class="active "':'';?>>
                <a href="<?= BASEURL?>Pengambilan_part">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Pengambilan Part</p>
                </a>
                </li>
            </ul>
            </div>
        </div>