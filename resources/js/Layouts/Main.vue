<script setup>
import Logo from "@/Components/Logo.vue";
import { switchTheme } from "@/theme";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const openSearch = ref(false);
</script>

<template>
  <div class="flex flex-col min-h-screen z-50">
    <header class="h-16 bg-white dark:bg-dark-2 sticky top-0 z-50 shadow-sm">
      <div class="container flex items-center gap-4 justify-between">
        <Logo />

        <!-- theme -->
        <div>
          <button @click="switchTheme" class="py-2 px-3">
            <i class="fa-solid fa-circle-half-stroke"></i>
          </button>
        </div>
      </div>
    </header>

    <!-- main -->
    <main class="flex-1">
      <slot></slot>
    </main>

    <!-- footer -->
    <footer class="h-16 bg-white dark:bg-dark-2">
      <div class="container flex items-center justify-between">
        <!-- <Logo /> -->
        <p>Copyright &copy; {{ new Date().getFullYear() }}</p>
        <div v-if="user">
          <Link
            @click="openNavUser = false"
            :href="route('logout')"
            method="post"
            as="button"
            class="p-2 bg-primary text-white rounded-lg mt-2 text-sm hover:underline"
            >Logout</Link
          >
        </div>
        <div v-else class="flex gap-4">
          <Link href="/login">Login</Link>
          <Link href="/register">Register</Link>
        </div>
      </div>
    </footer>
  </div>
</template>