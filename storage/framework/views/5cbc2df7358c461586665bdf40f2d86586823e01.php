
<?php $__env->startSection('content'); ?>
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-home navbar-expand-lg bg-white fixed-top">
      <div class="w-100 px-5">
        <a class="navbar-brand position-absolute" href="#">
          <img class="logo hover-translate-y-n3" src="assets/estay/images/logo/footer-logo.png" alt="estay logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav-social navbar-nav d-flex align-items-center">
            <li class="nav-item">
              <a class="nav-link text-primary-1">Theo dõi chúng tôi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_facebook']); ?>">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/twitter.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_twitter']); ?>">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/facebook.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e($static_data['site_settings']['social_instagram']); ?>">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/instagram.png" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" hhref="<?php echo e($static_data['site_settings']['social_youtube']); ?>">
                <img class="icon hover-translate-y-n3" src="assets/estay/images/icon/youtube.png" />
              </a>
            </li>
          </ul>

          <div class="dropdown ml-auto">
            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Giao diện khác
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/">Giao diện 1</a>
              <a class="dropdown-item" href="/explore/properties">Giao diện 2</a>
            </div>
          </div>

          <ul class="nav-action navbar-nav d-flex align-items-center ml-auto">
            <li class="nav-item">
              <a class="m-2 btn btn-primary-2 hover-btn">Đăng Ký Cho Thuê Nhà</a>
            </li>
                                <li class="nav-item dropdown dropdown-lg border-left">
                                <a href="#" class="nav-link dropdown-toggle text-dark" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if(Session::has('language')): ?>
                                    <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php if(Session::get('language')): ?>
                                            <?php if(strpos(Session::get('language'), $language->code) !== false): ?>
                                                <img class="icon hover-translate-y-n3" src="<?php echo e($language->flag); ?>" /> <?php echo e($language->language); ?>

                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e($default_language->language); ?>

                                    <?php endif; ?>
                                </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language-dropdown">
                                        <?php $__currentLoopData = $static_data['languages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                            <a class="dropdown-item language-switcher" data-code="<?php echo e($language->code); ?>" href="#"><img class="icon hover-translate-y-n3" src="<?php echo e($language->flag); ?>" /> <?php echo e($language->language); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </div>
                                </li>
            <li class="nav-item border-left">
              <a href="<?php echo e(route('login')); ?>" class="nav-link text-primary-1 text-uppercase font-weight-bold" href="#">
               <?php echo e($static_data['strings']['sign_in']); ?>

              </a>
            </li>
            <li class="nav-item border-left">
              <a href="<?php echo e(route('register')); ?>" class="m-2 btn btn-primary-2 hover-btn text-uppercase font-weight-bold">
               <?php echo e($static_data['strings']['register']); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="megamenu navbar-menu position-absolute">
            <a href="#" id="dropdownMegamenu" data-toggle="dropdown">
              <img class="logo hover-translate-y-n3 shadow-primary" src="assets/estay/images/icon/menu.png"/ alt="estay">
            </a>
            <div class="dropdown-menu py-4" aria-labelledby="dropdownMegamenu">
              <div class="container">
                <div class="row w-100">
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Về Estay</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Câu chuyện của Estay</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Địa chỉ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Tin tưởng & An toàn</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Tin tức</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Người dùng</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Đăng ký</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Thanh toán</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Trung tâm trợ giúp</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4">
                    <div class="megamenu-title mb-3">Đối tác</div>
                    <ul class="list-unstyled">
                        <li class="nav-item"><a class="nav-link" href="#">Đăng ký đối tác</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Trung tâm đối tác</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Chính sách</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Điều khoản dịch vụ</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </nav>
    <!-- END NAV -->
    <div class="hero">
      <img class="slogan-banner" src="assets/estay/images/banner/banner01.png" />
      <a class="btn-change-bg">Thay đổi hình nền</a>

    </div>
    <!-- END HERO -->
    <div class="search-form-wrapper w-100 px-5 py-3">
      <form class="search-form">
        <div class="row p-2">
          <div class="col-lg-3 col-md-12">
            <div class="form-group form-icon search mb-0">
              <input type="text" class="form-control mh-50" placeholder="Nhập địa điểm du lịch hoặc tên khách sạn">
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="form-group form-icon date mb-0">
              <span class="check-in">Check-in</span>
              <span class="check-out">Check-out</span>
              <input type="datetime" readonly class="form-control mh-50" name="daterange" value="" />
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="dropdown form-group form-icon guests mb-0">
              <button class="btn-block form-control mh-50" type="button" id="guestsdropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span>2 người lớn</span> -
                <span>1 trẻ em</span> -
                <span>1 phòng</span>
              </button>
              <div id="dropdownOpen" class="dropdown-menu w-100 p-3" aria-labelledby="guestsdropdown">
                <div class="row">
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Người lớn
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Trẻ em
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        Phòng
                      </div>
                      <div class="col-md-5 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-primary-2">+</button>
                          <input type="text" readonly value="0" class="form-control" />
                          <button type="button" class="btn btn-primary-2">-</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 py-2">
                    <label for="childrenSelect">Chọn tuổi của trẻ đi cùng</label>
                    <select class="form-control" id="childrenSelect">
                      <option value="0">0 tuổi</option>
                      <option value="1">1 tuổi</option>
                      <option value="2">2 tuổi</option>
                      <option value="3">3 tuổi</option>
                      <option value="4">4 tuổi</option>
                      <option value="5">5 tuổi</option>
                      <option value="6">6 tuổi</option>
                      <option value="7">7 tuổi</option>
                      <option value="8">8 tuổi</option>
                      <option value="9">9 tuổi</option>
                      <option value="10">10 tuổi</option>
                      <option value="11">11 tuổi</option>
                      <option value="12">12 tuổi</option>
                      <option value="13">13 tuổi</option>
                      <option value="14">14 tuổi</option>
                      <option value="15">15 tuổi</option>
                      <option value="16">16 tuổi</option>
                      <option value="17">17 tuổi</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-12">
            <button type="button" class="btn btn-search btn-primary-2 btn-block mh-50">TÌM</button>
          </div>
          <div class="col-lg-1 col-md-3 text-right" style="position: fixed;
    right: 40px;
    bottom: 30px;
    z-index: 99;">
            <button type="button" class="btn btn-chat btn-primary-2">
              <img class="icon" src="assets/estay/images/icon/chat.png" />
            </button>
          </div>
        </div>
      </form>
    </div>
    <!-- END SEARCH FORM -->
  </header>
  <!-- End header -->
  
  <!-- Chat Box-->
  <div class="chatbox-wrapper card shadow-secondary">
    <div class="chatbox-header p-2">Chat
      <a class="btn-chat float-right"><img class="icon-sm" src="assets/estay/images/icon/close-primary.svg"/></a>
    </div>
    <div class="px-4 py-5 chat-box card-body">
      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Anh và tôi thật ra gặp nhau và quen nhau cũng đã được mấy
              năm, mà chẳng có chi hơn lời hỏi thăm</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">rằng giờ này đã ăn sáng chưa? ở bên đấy nắng hay mưa?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Anh và tôi thật ra Mm, Mmm mải mê nhìn lén nhau, Và không
              một ai nói nên câu</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">Rằng người ơi tôi đang nhớ anh, Và anh có nhớ tôi không?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Sender Message-->
      <div class="media mb-3"><img src="assets/estay/images/icon/vector-avatars-1.png" alt="user" width="50"
          class="rounded-circle">
        <div class="media-body ml-3">
          <div class="bg-light rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-muted">Tôi... từ lâu đã thích anh rồi, Chỉ mong hai ta thành đôi
            </p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

      <!-- Reciever Message-->
      <div class="media ml-auto mb-3">
        <div class="media-body">
          <div class="bg-primary rounded py-2 px-3 mb-2">
            <p class="text-small mb-0 text-white">Anh nhà ở đâu thế?</p>
          </div>
          <p class="small text-muted">12:00 PM | Aug 13</p>
        </div>
      </div>

    </div>

    <!-- Typing area -->
    <form action="#" class="bg-light">
      <div class="input-group">
        <div contentEditable="true" placeholder="Type a message" aria-describedby="button-addon2"
          class="form-control chatinput rounded-0 border-0 py-2 bg-light">
          Anh nhà ở đâu...
        </div>
        <div class="input-group-append">
          <input class="d-none" type="file" id="FileUpload"/>
          <button onclick='$("#FileUpload").click()' id="button-addon2" type="file" class="btn btn-link">
            <img class="icon-sm" src="assets/estay/images/icon/attach.svg" />
          </button>
        </div>
        <div class="input-group-append">
          <button id="button-addon2" type="submit" class="btn btn-link">
            <img class="icon-sm" src="assets/estay/images/icon/send.svg" />
          </button>
        </div>
      </div>
    </form>

  </div>
  <!-- End Chat Box -->

  <!-- Main -->
  <div class="main">
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 text-left">
            <div class="section-title mb-4 pb-2">
              <h4 class="title mb-1">Voucher Hấp Dẫn</h4>
              <div class="d-flex justify-content-between">
                <p class="para-desc mb-0 d-block w-100">Nhận giá tốt nhất cho > 2.000.000 chổ nghỉ, trên toàn cầu.</p>
                <a href="#" class="btn btn-estay-primary">Xem tất cả</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="item-slider d-flex justify-content-center">

         

         <div class="item-slider d-flex justify-content-center">
        <div class="item">
          <a href="single.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/resort-001.jpg">
          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg">18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="single.html">Khám phá Đà Lạt cho 2 người - 1N1Đ Phòng Standard</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                <div class="text-muted">11.254.000đ</div>
                <p class="lead mb-0">5.600.000đ</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="single.html" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg">
              50 người mua
            </div>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="single.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/resort-001.jpg">
          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg">18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="single.html">Khám phá Đà Lạt cho 2 người - 1N1Đ Phòng Standard</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                <div class="text-muted">11.254.000đ</div>
                <p class="lead mb-0">5.600.000đ</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="single.html" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg">
              50 người mua
            </div>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="single.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/resort-001.jpg">
          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg">18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="single.html">Khám phá Đà Lạt cho 2 người - 1N1Đ Phòng Standard</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                <div class="text-muted">11.254.000đ</div>
                <p class="lead mb-0">5.600.000đ</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="single.html" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg">
              50 người mua
            </div>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="single.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/resort-001.jpg">
          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg">18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="single.html">Khám phá Đà Lạt cho 2 người - 1N1Đ Phòng Standard</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                <div class="text-muted">11.254.000đ</div>
                <p class="lead mb-0">5.600.000đ</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="single.html" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg">
              50 người mua
            </div>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="single.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/resort-001.jpg">
          </a>
          <div class="item-body">
            <span class="date"><img class="icon-ssm mr-1" src="assets/estay/images/icon/calendar.svg">18/01/2020 - 31/12/2020</span>
            <h3 class="item-title my-4">
              <a href="single.html">Khám phá Đà Lạt cho 2 người - 1N1Đ Phòng Standard</a>
            </h3>
            <div class="d-flex justify-content-between">
              <div class="price mr-2">
                <div class="text-muted">11.254.000đ</div>
                <p class="lead mb-0">5.600.000đ</p>             
              </div>
              <div class="d-flex align-items-center">
                <a href="single.html" class="btn btn-estay-primary">Mua ngay</a>
              </div>
            </div>
          </div>
          <div class="item-footer"> 
            <div class="rating">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <img class="star" src="assets/estay/images/icon/star-active.svg">
              <span class="ml-2">(20 đánh giá)</span>
            </div>
            <div class="buyers">
              <img class="icon-ssm" src="assets/estay/images/icon/user.svg">
              50 người mua
            </div>
          </div>
        </div>
        <!-- End item -->
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="col-12 text-left">
          <div class="section-title mb-4 pb-2">
            <h4 class="title mb-1">Tìm Theo Loại Chổ Nghỉ</h4>
            <div class="d-flex justify-content-between">
              <p class="para-desc mb-0 d-block w-100">Nhận giá tốt nhất cho > 2.000.000 chổ nghỉ, trên toàn cầu.</p>
              <a href="#" class="btn btn-estay-primary">Xem tất cả</a>
            </div>
          </div>
        </div>
      </div>
      <div class="category-slider d-flex justify-content-center">
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
        <div class="item">
          <a href="listing.html" class="item-img">
            <img class="item-thumb" src="assets/estay/images/item/canho.jpg"/>
          </a>
          <div class="item-body p-3">
            <h3 class="item-title">
              <img class="icon-sm mr-1" src="assets/estay/images/icon/pin-dark.svg"/>
              <a href="listing.html">Căn hộ</a>
            </h3>
            <p class="mb-0 amount">1500 resort</p>
          </div>
        </div>
        <!-- End item -->
      </div>
    </section>

  </div>
  
  <footer>
    <section class="section bg-light footer-top-menu">
      <div class="container">
        <div class="row">
            <div class="col">
              <h5><?php echo e($static_data['strings']['opt_footer_menu1_head']); ?></h5>
              <p class="mb-0">
                  <a href="<?php echo e($static_data['design_settings']['footer_menu1_link1']); ?>"><?php echo e($static_data['strings']['opt_footer_menu1_text1']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu1_link2']); ?>"><?php echo e($static_data['strings']['opt_footer_menu1_text2']); ?></a>
              </p>
              <p class="mb-0">
                  <a href="<?php echo e($static_data['design_settings']['footer_menu1_link3']); ?>"><?php echo e($static_data['strings']['opt_footer_menu1_text3']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu1_link4']); ?>"><?php echo e($static_data['strings']['opt_footer_menu1_text4']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu1_link5']); ?>"><?php echo e($static_data['strings']['opt_footer_menu1_text5']); ?></a>
              </p>
            </div>
            <div class="col">
              <h5><?php echo e($static_data['strings']['opt_footer_menu2_head']); ?></h5>
              <p class="mb-0">
                  <a href="<?php echo e($static_data['design_settings']['footer_menu2_link1']); ?>"><?php echo e($static_data['strings']['opt_footer_menu2_text1']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu2_link2']); ?>"><?php echo e($static_data['strings']['opt_footer_menu2_text2']); ?></a>
              </p>
              <p class="mb-0">
                  <a href="<?php echo e($static_data['design_settings']['footer_menu2_link3']); ?>"><?php echo e($static_data['strings']['opt_footer_menu2_text3']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu2_link4']); ?>"><?php echo e($static_data['strings']['opt_footer_menu2_text4']); ?></a>
              </p>
              <p class="mb-0">
                <a href="<?php echo e($static_data['design_settings']['footer_menu2_link5']); ?>"><?php echo e($static_data['strings']['opt_footer_menu2_text5']); ?></a>
              </p>
            </div>
             
        </div>
      </div>
    </section>
    <section class="section footer-secondary-menu">
      <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6">
              <h6>Quốc gia/Vùng lãnh thổ</h6>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
              <p class="mb-1">
                <a href="#">Khách sạn Úc</a>
              </p>
            </div>
        </div>
      </div>
    </section>
    <section class="section bg-light copyright">
      <div class="container-fluid px-5">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 text-right text">
            Bản Quyền Thuộc <b>Công Ty TNHH ABC</b>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 text-right">
            <a href="<?php echo e($static_data['site_settings']['social_facebook']); ?>" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/facebook.png"/>
            </a>
            <a href="<?php echo e($static_data['site_settings']['social_twitter']); ?>" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/twitter.png"/>
            </a>
            <a href="<?php echo e($static_data['site_settings']['social_instagram']); ?>" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/instagram.png"/>
            </a>
            <a href="<?php echo e($static_data['site_settings']['social_youtube']); ?>" class="m-1 img-social">
              <img class="icon-md" src="assets/estay/images/icon/youtube.png"/>
            </a>
          </div>
        </div>
      </div>
    </section>

  </footer>


 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home_layout', ['static_data', $static_data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>