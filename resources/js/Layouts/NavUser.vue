<script setup>
import { ref } from "vue";

defineProps({
  user: Object,
});

const openNavUser = ref(false);
</script>

<template>
  <div v-if="user" class="relative">
    <button @click="openNavUser = !openNavUser" class="py-2 px-3">
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
            <div>Halo {{ user.name }}</div>
            <button
              @click="openNavUser = false"
              type="button"
              title="close"
              class="border px-3 py-2"
            >
              <i class="fa-solid fa-times"></i>
            </button>
          </div>
          <Link
            @click="openNavUser = false"
            :href="route('logout')"
            method="post"
            as="button"
            class="p-2 bg-primary text-white rounded-lg mt-2 text-sm hover:underline"
            >Logout</Link
          >
        </div>
      </div>
    </div>
  </div>
  <div v-else class="flex gap-4">
    <Link href="/login">Login</Link>
    <Link href="/register">Register</Link>
  </div>
</template>