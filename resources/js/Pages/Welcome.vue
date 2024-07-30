<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>



<template>
  <!-- Overlay for Sidebar -->
    <div v-if="isSidebarVisible" class="overlay" @click="closeSidebarIfOpen"></div>
      <div>
        <div>

<!-- NAV---------------------------------------------------------------------------------------------------------BAR -->
<!-- NAV---------------------------------------------------------------------------------------------------------BAR -->
<!-- NAV---------------------------------------------------------------------------------------------------------BAR -->
      <!-- Main Navigation Bar -->
            <nav class="flex items-center justify-between p-4 bg-gray-800 relative z-50">
              <div class="nav-logo max-w-xs flex items-center" style="user-select: none;">
                <a href="/" class="flex items-center">
                  <img class="glow w-12 h-50" src="images/logo/WeblogoW.png" alt="Logo">
                  <span class="logo-text ml-2">BROOKLYN WAREHOUSE INC.</span>
                </a>
              </div>

      <!-- BURGER BUTTON (SMALL SCREEN) -->
              <button @click.stop="toggleSidebar" type="button" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
              </button>

      <!-- SIDEBAR (SMALL SCREEN) -->
              <div ref="sidebar" class="sidebar md:hidden" :class="{ 'show-sidebar': isSidebarVisible }" id="sidebar" @click.stop>         
                <a class="text-white text-lg no-underline block relative ml-5 mb-4" @click="showMessage('About')">About us</a>
                <a class="text-white text-lg no-underline block relative ml-5 mb-4" @click="showMessage('Contact')">Contact</a>
                <hr>

                <div class="relative ml-6 mt-5" @click.stop>
                  <div class="text-white text-lg no-underline cursor-pointer relative" @click="toggleProfileDropdown">
                    My Account
                    <svg class="inline-block ml-0 h-4 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                  <div v-if="isProfileDropdownOpen" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                    <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-500">Profile</a>
                    <form method="POST" action="/logout">
                      <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-100 hover:bg-gray-500">Log Out</button>
                    </form>
                  </div>
                </div>

        <!-- Icon for  Center and Sell -->
                <div class="Ownerlinks text-white text-lg no-underline block relative ml-6">
                  <i class="fa-solid fa-person-shelter"></i>
                  <div href="#" class="text-gray-400 text-lg no-underline block relative ml-1 mb-4">Store Center</div>
                  <div href="#" class="text-gray-400 text-lg no-underline block relative ml-1 mb-4">Sell Products</div>
                </div>
              </div>

      <!-- NAVBAR (LARGE SCREEN) -->
                <ul class="hidden md:flex md:items-center md:gap-1">
                  <li class="link">
                    <a href="#" class="text-white text-base no-underline relative ml-8 after:content-[''] after:absolute after:bottom-[-5px] after:h-0.5 after:w-0 after:bg-gray-400 after:transition-all after:duration-300 hover:after:w-full" @click="showMessage('About')">About us</a>
                  </li>
                  <li class="link">
                    <a href="#" class="text-white text-base no-underline relative ml-8 after:content-[''] after:absolute after:bottom-[-5px] after:h-0.5 after:w-0 after:bg-gray-400 after:transition-all after:duration-300 hover:after:w-full" @click="showMessage('Contact')">Contact</a>
                  </li>
                  <li class="link relative ml-8">
                    <div class="text-white text-base no-underline cursor-pointer relative" @click="toggleProfileDropdown">
                      Profile
                      <svg class="inline-block ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                      </svg>
                    </div>
                    <div v-if="isProfileDropdownOpen" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-700 ring-1 ring-black ring-opacity-5">
                      <a href="/profile" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-500">Profile</a>
                    </div>
                  </li>
                </ul>

            </nav>

<!-- SUB-NAV---------------------------------------------------------------------------------------------------------BAR -->
<!-- SUB-NAV---------------------------------------------------------------------------------------------------------BAR -->
<!-- SUB-NAV---------------------------------------------------------------------------------------------------------BAR -->
      <!-- Sub-Navigation Bar -->
          <div class="bg-gray-700 p-2">
              <div class="container mx-auto flex justify-between items-center">

                <div class="flex space-x-2 text-sm">
                <Link
                  :href="route('storecenter')"
                  class="text-gray-400 hover:text-white"
                >Store Center</Link>
                <span class="text-gray-400">|</span>
                <Link
                  href="/sell-product"
                  class="text-gray-400 hover:text-white"
                >Sell Product</Link>
              </div>

                <div class="flex space-x-2 ml-auto text-sm">
                  <template v-if="canLogin">
                    <Link
                      v-if="$page.props.auth.user"
                      :href="route('dashboard')"
                      class="font-semibold text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Dashboard</Link>
                    <template v-else>
                      <Link
                        :href="route('login')"
                        class="text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                      >Log in</Link>
                      <span class="text-gray-400">|</span>
                      <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="text-gray-400 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                      >Register</Link>
                    </template>
                  </template>
                </div>

              </div>
          </div>
        </div>


<!-- SEARCH---------------------------------------------------------------------------------------------------------BAR -->
<!-- SEARCH---------------------------------------------------------------------------------------------------------BAR -->
<!-- SEARCH---------------------------------------------------------------------------------------------------------BAR -->

  <!-- searchbar -->
      <div class="flex items-center max-w-sm mx-auto bg-gray-300 rounded-full shadow-md overflow-hidden" style="margin-top: 10px;">
        <input class="w-full bg-gray-300 rounded-full px-3 py-1 focus:outline-none" type="text" placeholder="Search...">
        <a class="bg-gray-700 text-white rounded-full p-1 hover:bg-gray-400 focus:outline-none w-7 h-7 flex items-center justify-center">
            <!-- Search icon -->
            <svg class="animate-bounce" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a7 7 0 1 1-7-7 7 7 0 0 1 7 7z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4-4" />
            </svg>
        </a>
      </div>





<!-- MODAL---------------------------------------------------------------------------------------------------------LINKS -->
<!-- MODAL---------------------------------------------------------------------------------------------------------LINKS -->
<!-- MODAL---------------------------------------------------------------------------------------------------------LINKS -->
    <!-- Modal[ Home , About us , Contact ] -->
      <div class="modal" v-if="modalVisible" @click.self="closeModal">
        <div class="modal-content">
          <span class="close" @click="closeModal">&times;</span>
          <div v-if="selectedPage === 'About'">
            <div class="glass-box">
              <h1>About Brooklyn <span>Warehouse</span> Inc.</h1><br>
              <p>Brooklyn Warehouse Inc. is not just a location; it's the backdrop to your most creative and memorable events. Specializing in providing a versatile rental space, we cater to a diverse array of occasions, from bustling bazaars to professional commercial shoots. Our warehouse is a canvas for your imagination, where each event is transformed into an extraordinary experience.</p>
              <p>Nestled within the heart of Brooklyn, our warehouse is complemented by the singular charm of our coffee shop. This cozy nook offers a delectable array of food and beverages, making it the perfect place to unwind or network during events. Whether you're orchestrating a commercial masterpiece or hosting a vibrant market event, Brooklyn Warehouse Inc. is your premier destination.</p><br>
              <p>Join us at Brooklyn Warehouse Inc., where every event is an opportunity to create, connect, and celebrate.</p>
            </div>
          </div>

          <div v-else-if="selectedPage === 'Contact'">
            <div class="contact-glass-box">
              <div class="contact-title">Contact</div>
              <div class="contact-card">
                <i class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                        <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38" cy="42.035" r="44.899" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fd5"></stop><stop offset=".328" stop-color="#ff543f"></stop><stop offset=".348" stop-color="#fc5245"></stop><stop offset=".504" stop-color="#e64771"></stop><stop offset=".643" stop-color="#d53e91"></stop><stop offset=".761" stop-color="#cc39a4"></stop><stop offset=".841" stop-color="#c837ab"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2" cx="11.786" cy="5.54" r="29.813" gradientTransform="matrix(1 0 0 .6663 0 1.849)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4168c9"></stop><stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop></radialGradient><path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)" d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"></path><path fill="#fff" d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"></path><circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle><path fill="#fff" d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"></path>
                    </svg>
                </i>
                <p class="contact-text">
                  <a href="javascript:void(0);" @click="openPopup('https://www.instagram.com/brooklyn.warehouse/', 'Instagram', 500, 600);">
                    @brooklyn.warehouse
                  </a>
                </p>
              </div>
              <div class="contact-card">
                <i class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                        <path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"></path><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"></path><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"></path><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"></path><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"></path>
                    </svg>
                </i>
                <p class="contact-text">09612648064</p>
              </div>
              <div class="contact-card">
                <i class="contact-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48">
                        <path fill="#48b564" d="M35.76,26.36h0.01c0,0-3.77,5.53-6.94,9.64c-2.74,3.55-3.54,6.59-3.77,8.06	C24.97,44.6,24.53,45,24,45s-0.97-0.4-1.06-0.94c-0.23-1.47-1.03-4.51-3.77-8.06c-0.42-0.55-0.85-1.12-1.28-1.7L28.24,22l8.33-9.88	C37.49,14.05,38,16.21,38,18.5C38,21.4,37.17,24.09,35.76,26.36z"></path><path fill="#fcc60e" d="M28.24,22L17.89,34.3c-2.82-3.78-5.66-7.94-5.66-7.94h0.01c-0.3-0.48-0.57-0.97-0.8-1.48L19.76,15	c-0.79,0.95-1.26,2.17-1.26,3.5c0,3.04,2.46,5.5,5.5,5.5C25.71,24,27.24,23.22,28.24,22z"></path><path fill="#2c85eb" d="M28.4,4.74l-8.57,10.18L13.27,9.2C15.83,6.02,19.69,4,24,4C25.54,4,27.02,4.26,28.4,4.74z"></path><path fill="#ed5748" d="M19.83,14.92L19.76,15l-8.32,9.88C10.52,22.95,10,20.79,10,18.5c0-3.54,1.23-6.79,3.27-9.3	L19.83,14.92z"></path><path fill="#5695f6" d="M28.24,22c0.79-0.95,1.26-2.17,1.26-3.5c0-3.04-2.46-5.5-5.5-5.5c-1.71,0-3.24,0.78-4.24,2L28.4,4.74	c3.59,1.22,6.53,3.91,8.17,7.38L28.24,22z"></path>
                    </svg>
                </i>
                <p class="contact-text">
                  <a href="javascript:void(0);" @click="openPopup('https://www.google.com/maps/dir/14.5995124,120.9842195/14.6011592,120.9899573/@14.6015444,120.9816455,16z/data=!3m1!4b1!4m4!4m3!1m1!4e1!1m0?entry=ttu', 'Google Maps', 700, 600);">
                    2119 C.M. Recto Avenue, Manila, Philippines
                  </a>
                </p>
              </div>
            </div>
          </div>

          <div v-else>
            <p>{{ modalMessage }}</p>
          </div>
        </div>
      </div>


    </div>
    
</template>



<script>
    export default {
      components: {
      },
      data() {
        return {
          isSidebarVisible: false,
          modalVisible: false,
          modalMessage: '',
          selectedPage: '',
          isProfileDropdownOpen: false,
          canLogin: true,
          canRegister: true,
        };
      },
      methods: {
        toggleProfileDropdown() {
          this.isProfileDropdownOpen = !this.isProfileDropdownOpen;
        },
        toggleSidebar() {
          this.isSidebarVisible = !this.isSidebarVisible;
        },
        closeSidebarIfOpen() {
          if (this.isSidebarVisible) {
            this.isSidebarVisible = false;
          }
        },
        showMessage(page) {
          if (page === 'About') {
            this.selectedPage = 'About';
          } else if (page === 'Contact') {
            this.selectedPage = 'Contact';
          } else {
            this.modalMessage = `You clicked on "${page}" link.`;
            this.selectedPage = '';
          }
          this.modalVisible = true;
        },
        closeModal() {
          this.modalVisible = false;
          this.selectedPage = '';
        },
        openPopup(url, title, width, height) {
          var left = (screen.width - width) / 2;
          var top = (screen.height - height) / 2;
          var popupWindow = window.open(url, title, 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left);
          if (window.focus) {
            popupWindow.focus();
          }
          return false;
        },
      },
      mounted() {
        // Check screen width on component mount
        this.isSmallScreen = window.innerWidth <= 640;
        // Listen for window resize events
        window.addEventListener('resize', () => {
          this.isSmallScreen = window.innerWidth <= 640;
        });
      },
    };
</script>


<style scoped>
      /* LOGO TEXT CSS */
              .logo-text {
                  font-family: 'Times New Roman', Times, serif;
                  color: snow;
                  font-size: calc(0.45em + 1vw); /* Responsive font size */
                  white-space: nowrap; /* Prevents the text from wrapping */
              }

              /* LOGO CSS */
              .glow {
                  filter: drop-shadow(0 0 2px #c9c9c9) 
                          drop-shadow(0 0 6px #a4a4c2) 
                          drop-shadow(0 0 10px #696969);
              }

              /* NAVBAR LINKS */
              .link a::after {
                  left: 50%; /* Center the pseudo-element */
                  right: 50%; /* Center the pseudo-element */
                  transform: translateX(-50%); /* Shift it back to align with the text */
              }
              .Ownerlinks{
                margin-top: 100px;
              }
              .sub-link a::after {
                  left: 50%; /* Center the pseudo-element */
                  right: 50%; /* Center the pseudo-element */
                  transform: translateX(-50%); /* Shift it back to align with the text */
              }

              /* SIDEBAR */
              .overlay {
                  position: fixed;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background: rgba(0, 0, 0, 0.5);
                  z-index: 1; /* Ensure the overlay is above the main content but below the sidebar */
              }

              .sidebar {
                  position: fixed;
                  top: 70px; /* Adjust this value to the height of your nav bar */
                  right: -100%; /* Start off-screen to the right */
                  width: 150px; /* Width of the sidebar */
                  height: calc(100% - 70px); /* Adjust the height to account for the nav bar */
                  background-color: #2d3748;
                  transition: right 0.4s ease-in-out, opacity 0.4s ease-in-out;
                  display: flex;
                  flex-direction: column;
                  padding-top: 1rem; /* Adjust space for burger button if needed */
                  opacity: 0; /* Start with opacity set to 0 */
                  z-index: 2; /* Ensure the sidebar is above the overlay */
              }

              .sidebar.show-sidebar {
                  right: 0;
                  opacity: 1; /* Fade in when showing the sidebar */
              }

              .sidebar a {
                  right: 20px;
                  display: flex;
                  padding: 1rem;
                  font-size: 1.25rem;
                  text-decoration: none;
                  color: snow;
                  transition: background-color 0.3s ease-in-out;
              }

              .sidebar a:hover {
                  background-color: #4a5568;
              }
              .login-register-links {
                display: flex;
                justify-content: center;
                margin-top: auto;
              }

            /* MODAL */
                .modal {
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  position: fixed;
                  z-index: 1000;
                  left: 0;
                  top: 0;
                  width: 100%;
                  height: 100%;
                  overflow:auto;
                  background-color: rgba(0, 0, 0, 0.5);
                }
                .modal-content {
                  text-align: center;
                  background-color: rgba(255, 250, 250, 0.5);
                  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                  
                  border: 1px solid #5d5d5d;
                  padding: 20px;
                  border-radius: 8px; 
                  width: 100%; 
                  max-width: 350px;
                  max-height: 90%;
                  position: relative; 
                }
                .close {
                  color: #5d5d5d;
                  float: right;
                  font-size: 28px;
                  font-weight: bold;
                  position: absolute; /* Position the close button */
                  top: 1px; /* Adjust the position as needed */
                  right: 5px; /* Adjust the position as needed */
                  cursor: pointer;
                }
                .close:hover,
                .close:focus {
                  color: #000;
                  text-decoration: none;
                  cursor: pointer;
                }
                .glass-box h1 {
                  text-align: center;
                  font-size: 2rem;
                  color: rgb(0, 0, 0);
                  user-select: none;
                }
                .glass-box h1 span {
                  -webkit-text-fill-color:transparent;
                  -webkit-text-stroke: 1px #000000;
                }
                .glass-box p {
                  font-size: 13px;
                  cursor: none;
                  user-select: none;
                  color:#0f0808;
                }

                /* Contact Glass Box */
                .contact-glass-box{
                  text-align: center;
                }
                /* Contact Title */
                .contact-title {
                  font-size: 2rem;
                  color: rgb(0, 0, 0);
                  margin-bottom: 1rem;
                  user-select: none;
                }

                /* Contact Card */
                .contact-card {
                  background: rgba(255, 255, 255, 0);
                  border-radius: 10px;
                  margin: auto;
                  padding: 5px;
                  margin-bottom: 5px;
                  width: 80%; /* Adjust width to be more flexible */
                  max-width: 350px; /* Maximum width for larger screens */
                  transition: transform 0.3s ease;
                }
                .contact-card:hover {
                  background-color: rgb(190, 190, 190, 1);
                }

                /* Contact Icon */
                .contact-icon {
                  color: rgb(0, 0, 0);
                  font-size: 1.5rem;
                  display: flex;
                  justify-content: center
                }

                /* Contact Text */
                .contact-text {
                  color: rgb(0, 0, 0);
                  font-size: 1.25rem;
                  align-items: center;
                  
                }
                /* Contact Link */
                .contact-text a {
                  color: #000000;
                  text-decoration: none;
                }

                /* Contact Link Hover */
                .contact-text a:hover {
                  text-decoration: underline;
                }
</style>
<style>
                body {
                  background-color: #99aab5;
                }
</style>

