<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    />

    <!--Fontawesome CDN-->
    <script
      src="https://kit.fontawesome.com/962cfbd2be.js"
      crossorigin="anonymous"
    ></script>

    <!--External CSS-->
    <link rel="stylesheet" href="style.css" />

    <title>Hello, world!</title>
  </head>
  <body>
    <header>
      <!--Navbar Section-->
      <nav class="navbar navbar-expand-lg position-relative">
        <!--Logo-->
        <a class="navbar-brand position-relative" href="#">
          <img src="./images/homepage/logo/logo.png" class="ml-3" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-align-justified"
            width="35"
            height="35"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="#15c0a6"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="4" y1="6" x2="20" y2="6" />
            <line x1="4" y1="12" x2="20" y2="12" />
            <line x1="4" y1="18" x2="16" y2="18" />
          </svg>
        </button>

        <!--Navbar Items-->
        <div class="collapse navbar-collapse mr-0" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto mr-5 font-rale">
            <li class="nav-item active mx-3">
              <a class="nav-link" href="#"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>

            <li class="nav-item mx-3 dropdown">
              <a class="nav-link" href="#" data-toggle="dropdown">
                Shops
                <i class="fas fa-chevron-down mx-1"></i>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Bakery</a>
                <a class="dropdown-item" href="#">Butcher</a>
                <a class="dropdown-item" href="#">Greengrocer</a>
                <a class="dropdown-item" href="#">Fishmonger</a>
                <a class="dropdown-item" href="#">Delicatessen</a>
              </div>
            </li>

            <li class="nav-item mx-3">
              <a href="#" class="nav-link">About Us</a>
            </li>

            <li class="nav-item mx-3">
              <a class="nav-link" href="#">Login</a>
            </li>

            <li class="nav-item mx-3">
              <a href="" class="nav-link nav-link-item">Sign Up</a>
            </li>

            <li class="nav-item mx-3">
              <a href="#" class="nav-link cart rounded">
                <i class="fas fa-shopping-cart"></i>
                <span class="mx-2">0</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!--Carousel Slider-->
      <div class="position-absolute carousel-container">
        <div
          id="carouselExampleControls"
          class="carousel slide"
          data-ride="carousel"
        >
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img
                class="d-block w-100"
                src="./images/homepage/bg/bg.jpg"
                alt="First slide"
              />
            </div>
            <div class="carousel-item">
              <img
                class="d-block w-100"
                src="./images/homepage/bg/main-bg.jpg"
                alt="Second slide"
              />
            </div>
          </div>
        </div>
      </div>

      <!--Carouel Headings-->
      <div class="carousel-heading position-absolute text-center">
        <h2 class="font-cursive heading">Welcome to Nature's Fresh Mart</h2>
        <div class="btn-container text-center">
          <button class="btn btn-first">Login</button>
          <button class="btn btn-second">Explore</button>
        </div>
      </div>
    </header>

    <main>
      <!--Why Nature's Fresh Mart-->
      <section class="features mt-5">
        <h2 class="font-cursive text-center">Why Nature's Fresh Mart</h2>
        <hr class="horizantal-break my-3" />

        <div class="container-fluid w-100">
          <div class="row my-5">
            <div class="col-xl-4 border feature-first font-rubik px-5">
              <p class="text-center mt-3">
                <img
                  src="./images/homepage/features/orange_travelpictdinner_1484336833.png"
                />
              </p>

              <h5 class="mt-4 text-center">High Quality Products</h5>
              <p class="mt-4 text-dark text-justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                doloremque dolores inventore dignissimos, consectetur id
                reiciendis, officiis numquam temporibus molestiae odio itaque
                accusantium ex eius culpa obcaecati quod dolore quis, deleniti
              </p>
            </div>

            <div class="col-xl-4 border feature-first font-rubik px-5">
              <p class="text-center mt-3">
                <img
                  src="./images/homepage/features/5830939211582692246.svg"
                  class="family"
                />
              </p>

              <h5 class="mt-4 text-center">We have a Large Family</h5>
              <p class="mt-4 text-dark text-justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                doloremque dolores inventore dignissimos, consectetur id
                reiciendis, officiis numquam temporibus molestiae odio itaque
                accusantium ex eius culpa obcaecati quod dolore quis, deleniti
              </p>
            </div>

            <div class="col-xl-4 border feature-first font-rubik px-5">
              <p class="text-center mt-3">
                <img src="./images/homepage/features/delivery-truck.png" />
              </p>

              <h5 class="mt-4 text-center">Timely delivery</h5>
              <p class="mt-4 text-dark text-justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum
                doloremque dolores inventore dignissimos, consectetur id
                reiciendis, officiis numquam temporibus molestiae odio itaque
                accusantium ex eius culpa obcaecati quod dolore quis, deleniti
              </p>
            </div>
          </div>
        </div>
      </section>

      <br />

      <!--Why you will love us-->
      <section class="platform-description bg-light pt-5 pb-1">
        <h2 class="font-cursive text-center">Why you'll love us....</h2>
        <hr class="horizantal-break my-3" />

        <div class="container-fluid love-us">
          <div class="row">
            <div class="col-xl-7 font-rubik mt-5">
              <div class="points d-flex align-items-center">
                <p class="bullets bullet-first">1</p>
                <p class="mx-4">
                  On average, plat, insect and bird life is 50% more abundant on
                  organic farms.
                </p>
              </div>

              <br />

              <div class="points d-flex align-items-center">
                <p class="bullets">2</p>
                <p class="mx-4">
                  We deliver to each area on the same day each week, to keep
                  emission low.
                </p>
              </div>

              <br />

              <div class="points d-flex align-items-center">
                <p class="bullets">3</p>
                <p class="mx-4">
                  We're pioneers of low plastic in the UK 75% less plastic in
                  our organic Fruit & Veg Boxes.
                </p>
              </div>

              <br />

              <div class="points d-flex align-items-center">
                <p class="bullets">4</p>
                <p class="mx-4">
                  We reckon our reusable boxes have saved over 65,000 plastic
                  bags.
                </p>
              </div>
            </div>

            <div class="col-xl-3 mb-5">
              <h2 class="ls-f"><strong> AWARD WINNING </strong></h2>
              <img
                src="./images/homepage/loveus/pexels-adonyi-gábor-1400172.jpg"
                width="300px"
                height="200px"
                class="love-f-img"
              />

              <h2 class="ls-s"><strong> SUSTAINABLE </strong></h2>
              <img
                src="./images/homepage/loveus/pexels-anton-atanasov-221016.jpg"
                width="260px"
                height="160px"
                class="love-s-img"
              />
            </div>

            <div class="col-xl-2 align-self-center">
              <h2 class="ls-t"><strong> SEASONAL </strong></h2>
              <img
                src="./images/homepage/loveus/pexels-pixabay-161573.jpg"
                width="200px"
                height="150px"
                class="love-t-img"
              />
            </div>
          </div>
        </div>
      </section>

      <!--Trader's Image Section-->
      <section class="header-img my-5">
        <h2 class="text-center font-cursive">Explore our shops</h2>
        <hr class="horizantal-break" />

        <div class="custom-container mt-5">
          <div class="column column-first position-relative">
            <img
              src="./images/homepage/traders/butcher.jpg"
              class="column-img"
              alt=""
            />
            <a href="#" class="position-absolute font-rale">Butcher</a>
          </div>

          <div class="column column-middle">
            <img
              src="./images/homepage/traders/fishmonger.jpg"
              class="column-img"
              alt=""
            />
            <a href="#" class="position-absolute font-rale">Fishmonger</a>
          </div>

          <div class="column column-middle">
            <img
              src="./images/homepage/traders/delicatessen.jpg"
              class="column-img"
              alt=""
            />
            <a href="#" class="position-absolute font-rale">Delicatessen</a>
          </div>

          <div class="column column-middle">
            <img
              src="./images/homepage/traders/greengrocer.jpg"
              class="column-img"
              alt=""
            />
            <a href="#" class="position-absolute font-rale">Greengrocer</a>
          </div>

          <div class="column column-last">
            <img
              src="./images/homepage/traders/bakery.jpg"
              class="column-img"
              alt=""
            />
            <a href="#" class="position-absolute font-rale">Bakery</a>
          </div>
        </div>
      </section>

      <br />
      <br />
      <br />

      <!--Frequently asked questions-->
      <section class="w-75 mx-auto item-description my-5">
        <h2 class="font-cursive text-center">Frequently Asked Questions</h2>
        <hr class="horizantal-break my-3" />
        <div class="row my-5">
          <div class="col-5 col-sm-5 col-md-4 col-lg-5 col-xl-4 mx-auto">
            <img
              src="./images/homepage/faq/undraw_real_time_collaboration_c62i (1).svg"
              class="w-100"
              alt=""
            />
          </div>
          <div class="col-10 col-sm-10 col-md-7 col-lg-6 col-xl-6 mx-auto">
            <div id="accordion">
              <div class="card">
                <div
                  class="
                    card-header
                    d-flex
                    align-items-start
                    justify-content-between
                  "
                  data-toggle="collapse"
                  data-target="#collapseOne"
                  aria-expanded="true"
                  aria-controls="collapseOne"
                  id="headingOne"
                >
                  <p class="font-rale">How to view above image</p>
                  <i class="fas fa-chevron-down"></i>
                </div>

                <div
                  id="collapseOne"
                  class="collapse show"
                  aria-labelledby="headingOne"
                  data-parent="#accordion"
                >
                  <div class="card-body">
                    <p class="font-rubik">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                      tempor, sunt aliqua put a bird on it squid single-origin
                      coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice
                      lomo. Leggings occaecat craft beer farm-to-table, raw
                      denim aesthetic synth nesciunt you probably haven't heard
                      of them accusamus labore sustainable VHS.
                    </p>
                  </div>
                </div>
              </div>
              <div class="card">
                <div
                  class="
                    card-header
                    d-flex
                    align-items-center
                    justify-content-between
                  "
                  data-toggle="collapse"
                  data-target="#collapseTwo"
                  aria-expanded="false"
                  aria-controls="collapseTwo"
                  id="headingTwo"
                >
                  <p class="font-rale">What are collection slots</p>
                  <i class="fas fa-chevron-down"></i>
                </div>
                <div
                  id="collapseTwo"
                  class="collapse"
                  aria-labelledby="headingTwo"
                  data-parent="#accordion"
                >
                  <div class="card-body">
                    <p class="font-rubik">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                      tempor, sunt aliqua put a bird on it squid single-origin
                      coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice
                      lomo. Leggings occaecat craft beer farm-to-table, raw
                      denim aesthetic synth nesciunt you probably haven't heard
                      of them accusamus labore sustainable VHS.
                    </p>
                  </div>
                </div>
              </div>
              <div class="card">
                <div
                  class="
                    card-header
                    d-flex
                    align-items-center
                    justify-content-between
                  "
                  class="btn btn-link collapsed"
                  data-toggle="collapse"
                  data-target="#collapseThree"
                  aria-expanded="false"
                  aria-controls="collapseThree"
                  id="headingThree"
                >
                  <p class="font-rale">More Info</p>
                  <i class="fas fa-chevron-down"></i>
                </div>
                <div
                  id="collapseThree"
                  class="collapse"
                  aria-labelledby="headingThree"
                  data-parent="#accordion"
                >
                  <div class="card-body">
                    <p class="font-rubik">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life
                      accusamus terry richardson ad squid. 3 wolf moon officia
                      aute, non cupidatat skateboard dolor brunch. Food truck
                      quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                      tempor, sunt aliqua put a bird on it squid single-origin
                      coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                      helvetica, craft beer labore wes anderson cred nesciunt
                      sapiente ea proident. Ad vegan excepteur butcher vice
                      lomo. Leggings occaecat craft beer farm-to-table, raw
                      denim aesthetic synth nesciunt you probably haven't heard
                      of them accusamus labore sustainable VHS.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!--Footer-->
      <footer class="mt-5">
        <div class="container-fluid">
          <div class="row">
            <!--Column First-->
            <div class="col-xl-2 mx-3 font-rale">
              <ul>
                <li class="text-uppercase">Information</li>
                <li class="mt-2">Contact Us</li>
                <li>FAQ</li>
                <li>Recipes</li>
                <li>Sustainability</li>
                <li>Terms & Conditions</li>
              </ul>
            </div>

            <!--Column Second-->
            <div class="col-xl-3 mx-3 font-rale">
              <p class="text-uppercase">Become our customer</p>
              <div class="input-container d-flex">
                <input
                  type="text"
                  class="font-rubik"
                  name="mail-field"
                  placeholder="xyz@gmail.com"
                />
                <button type="btn" class="btn font-rubik">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </div>

            <!--Column Third-->
            <div class="info col-xl-3 ml-4 pl-5 font-rale">
              <p class="text-uppercase">Contact Us</p>
              <div class="social-media-links">
                <a href="#"
                  ><i class="fab fa-2x mr-2 text-primary fa-facebook-f"></i
                ></a>
                <a href="#"><i class="fab fa-2x mx-2 fa-twitter"></i></a>
                <a href="#">
                  <i class="fab fa-2x mx-2 fa-linkedin"></i>
                </a>
                <a href="#">
                  <i class="fab fa-2x mx-2 text-danger fa-pinterest"></i>
                </a>
              </div>

              <a
                class="d-block mt-2 text-light"
                href="mailto:organic@freshmart.co.uk"
                >organic@freshmart.co.uk
                <i class="fa fa-envelope" aria-hidden="true"></i
              ></a>

              <a class="d-block text-light" href="tel:03452626262">
                03452 62 62 62
                <i
                  class="
                    fa fa-phone
                    animate__animated animate__rubberBand animate__infinite
                    fa-sm
                  "
                  aria-hidden="true"
                ></i
              ></a>
            </div>

            <!--Column Fourth-->
            <div class="col-xl-3 footer-img">
              <img
                src="./images/homepage/logo/footer_logo.png"
                class="w-100"
                alt=""
              />
            </div>
          </div>
        </div>
      </footer>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!--External Scripts-->
    <script src="vendor.js"></script>
  </body>
</html>