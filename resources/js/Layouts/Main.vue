<script setup>
import Logo from "@/Components/Logo.vue";
import { switchTheme } from "@/theme";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import NavUser from "./NavUser.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const openSearch = ref(false);
</script>

<template>
  <div class="flex flex-col min-h-screen z-50">
    <header class="h-16 bg-white dark:bg-dark-2 sticky top-0 z-50 shadow-sm">
      <div class="container flex items-center gap-4 justify-between">
        <Logo />

        <nav class="flex items-center gap-1">
          <!-- nav user -->
          <NavUser :user="user" />

          <!-- theme -->
          <div>
            <button @click="switchTheme" class="btn-icon">
              <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
          </div>
        </nav>
      </div>
    </header>

    <!-- main -->
    <main class="flex-1">
      <slot></slot>
    </main>

    <!-- footer -->
    <footer class="h-16 bg-white dark:bg-dark-2">
      <div class="container flex items-center justify-between">
        <p>Copyright &copy; {{ new Date().getFullYear() }}</p>
      </div>
    </footer>
  </div>
</template>

