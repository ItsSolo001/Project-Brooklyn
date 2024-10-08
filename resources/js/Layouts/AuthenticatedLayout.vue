<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Logo from '@/Components/Logo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { usePermission } from '@/composables/permissions';

const { auth } = usePage().props;
const { hasRole, hasRoles } = usePermission();

const showingNavigationDropdown = ref(false);
const dropdownRef = ref(null);

const isAboutModalVisible = ref(false);

const showModal = (type) => {
  if (type === 'About') {
    isAboutModalVisible.value = true;
  } else if (type === 'Contact') {
    // Handle contact modal logic if needed
  }
};

const toggleDropdown = () => {
  showingNavigationDropdown.value = !showingNavigationDropdown.value;
};

const closeDropdown = () => {
  showingNavigationDropdown.value = false;
};

const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    closeDropdown();
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between h-16">
            <div class="flex items-center space-x-4">
              <!-- Logo and Company Name -->
              <div class="flex items-center space-x-2">
                <Logo />
                <span class="text-gray-400 text-xl whitespace-nowrap font-serif">BROOKLYN WAREHOUSE INC.</span>
              </div>

              <!-- Navigation Links -->
              <div class="hidden sm:flex items-center space-x-4">
                <span class="text-gray-400">‖</span>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</NavLink>

                <NavLink v-if="hasRole('admin')" :href="route('users.index')" :active="route().current('users.index')">
                  Admin
                </NavLink>

                <!-- <NavLink v-if="hasRoles('admin')" :href="route('posts.index')" :active="route().current('posts.index')">
                  Posts
                </NavLink> -->

                <NavLink v-if="hasRole('moderator')" :href="route('stores.create')" :active="route().current('stores.index')">
                  Create Store
                </NavLink>

              </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
              <div class="relative">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                      >
                        {{ $page.props.auth.user.name }}
                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 0 01-1.414 0l-4-4a 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger Menu -->
            <div class="-me-2 flex items-center sm:hidden">
              <button
                @click.stop="toggleDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
              >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                    :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
          ref="dropdownRef"
          :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
          class="sm:hidden floating-dropdown"
        >
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
          </div>

          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('stores.create')" :active="route().current('stores.create')">Create Store</ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
              <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $page.props.auth.user.name }}</div>
              <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
              <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>
/* Adjustments for responsive design */
@media (max-width: 640px) {
  .nav-links {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .nav-links a {
    margin-top: 0.5rem;
  }
}

@media (min-width: 640px) {
  .nav-links {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 1rem;
  }
}

.floating-dropdown {
  position: absolute;
  top: 1;
  left: 0;
  right: 0;
  z-index: 10; /* Ensure this is higher than other content */
  background-color: #1a202c; /* Optional: Adjust background color as needed */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
}
</style>
