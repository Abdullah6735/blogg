<template>
    <div class="d-flex flex-column vh-100 p-3 bg-light">
      <nav>
        <ul class="nav flex-column">
          <!-- Categories Dropdown -->
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="usersDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Users
            </a>
            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                <li><Link class="dropdown-item" :href="route('users.index')">Users</Link></li>
              <!-- <li><Link class="dropdown-item" :href="route('categories.index')">All Categories</Link></li>
              <li><Link class="dropdown-item" :href="route('categories.create')">Add New Category</Link></li> -->
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="postsDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Posts
            </a>
            <ul class="dropdown-menu" aria-labelledby="postsDropdown">
              <li><Link class="dropdown-item" :href="route('posts.index')">All Posts</Link></li>
              <li><Link class="dropdown-item" :href="route('posts.create')">Add New Post</Link></li>
              <li><Link class="dropdown-item" :href="route('categories.index')">All Categories</Link></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </template>

  <script setup>
  import { Link, usePage } from '@inertiajs/vue3';
  const { props } = usePage();

  function canAccess(permission) {
    return props.auth?.permissions?.includes(permission) || false;
}

  </script>

  <style scoped>
  .nav-link.active {
    font-weight: bold;
  }
  </style>
