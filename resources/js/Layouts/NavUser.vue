<script setup>
import { ref } from "vue";

defineProps({
  user: Object,
});

const openNavUser = ref(false);
</script>

<template>
  <div v-if="user" class="relative">
    <button @click="openNavUser = !openNavUser" class="btn-icon">
      <i class="fa-solid fa-user"></i>
    </button>
    <div
      @click="openNavUser = false"
      class="fixed inset-0 bg-black/50 transition-all z-50"
      :class="openNavUser ? 'visible opacity-100' : 'invisible opacity-0'"
    >
      <div
        @click="(e) => e.stopPropagation()"
        class="w-72 bg-white h-full absolute right-0 dark:bg-dark-2 transition-all"
        :class="openNavUser ? 'translate-x-0' : 'translate-x-full'"
      >
        <div class="p-3">
          <div class="flex items-center justify-between">
            <p class="font-semibold">Halo {{ user.name }}</p>
            <button
              @click="openNavUser = false"
              type="button"
              aria-label="close nav user"
              class="btn-icon"
            >
              <!-- <i class="fa-solid fa-user"></i> -->
              <i class="fa-solid fa-times"></i>
            </button>
          </div>
          <nav class="space-y-1 mt-2">
            <Link
              @click="openNavUser = false"
              :href="route('user.schedule')"
              class="btn-nav"
              >Jawal Saya</Link
            >
            <Link
              @click="openNavUser = false"
              :href="route('home')"
              class="btn-nav"
              >Jawal Semua</Link
            >
            <Link
              @click="openNavUser = false"
              :href="route('logout')"
              method="post"
              as="button"
              class="btn-nav !text-danger"
              >Logout</Link
            >
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div v-else class="flex items-center gap-4">
    <Link href="/login" class="link">Login</Link>
    <Link href="/register" class="btn !px-4">Register</Link>
  </div>
</template>