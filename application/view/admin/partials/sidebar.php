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
          </li>
          <li <?= ($data['menu'] == 'part_masuk')?' class="active "':'';?>>
            <a href="<?= BASEURL ?>Part_masuk">
              <i class="nc-icon nc-box"></i>
              <p>Part Masuk</p>
            </a>
          </li>
          <li <?= ($data['menu'] == 'list_part')?' class="active "':'';?>>
            <a href="<?= BASEURL?>List_part">
              <i class="nc-icon nc-box-2"></i>
              <p>List Part</p>
            </a>
          </li>
          <li <?= ($data['menu'] == 'supplier')?' class="active "':'';?>>
            <a href="<?= BASEURL?>Supplier">
              <i class="nc-icon nc-single-02"></i>
              <p>Supplier</p>
            </a>
          </li>
          <li <?= ($data['menu'] == 'approval_pengajuan')?' class="active "':'';?>>
            <a href="<?= BASEURL?>Approval_pengajuan">
              <i class="nc-icon nc-tile-56"></i>
              <p>Approval Pengajuan</p>
            </a>
          </li>
          <li <?= ($data['menu'] == 'report_item_keluar')?' class="active "':'';?>>
            <a href="<?= BASEURL?>Report_item_keluar">
              <i class="nc-icon nc-paper"></i>
              <p>Report Item Keluar</p>
            </a>
          </li>
          <!-- <li class="active-pro">
            <a href="./upgrade.html">
              <i class="nc-icon nc-spaceship"></i>
              <p>Upgrade to PRO</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>