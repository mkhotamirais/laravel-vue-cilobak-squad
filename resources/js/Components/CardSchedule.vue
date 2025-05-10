<script setup>
import { formatTanggal } from "@/functions";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  s: Object,
  userid: String,
  searchTerm: String,
  institusiTerm: String,
  forDashboard: { type: Boolean, default: false },
});

const chooseInstitusi = (e) => {
  router.get(route("home"), {
    institusi: e,
    search: props.searchTerm || null,
    user: props.userid || null,
  });
};

const chooseUser = (e) => {
  router.get(route("home"), {
    userid: e,
    institusi: props.institusiTerm || null,
    search: props.searchTerm || null,
  });
};
</script>

<template>
  <div class="bg-white dark:bg-dark-2 shadow-sm rounded-md p-4 space-y-2">
    <p>
      <i class="fa-solid fa-book text-primary mr-2"></i>
      {{ s.mata_pelajaran }}
    </p>

    <button v-if="forDashboard" class="uppercase font-semibold !text-primary">
      <i class="fa-solid fa-university text-primary mr-2"></i>
      {{ s.institusi.replace("_", " ") }}
    </button>
    <button
      v-else
      @click="chooseInstitusi(s.institusi)"
      class="uppercase font-semibold !text-primary hover:underline"
    >
      <i class="fa-solid fa-university text-primary mr-2"></i>
      {{ s.institusi.replace("_", " ") }}
    </button>

    <p>
      <i class="fa-solid fa-calendar-days text-primary mr-2"></i>
      {{ formatTanggal(s.tanggal) }}
    </p>
    <p class="">
      <i class="fa-solid fa-book-open text-primary mr-1"></i>
      {{ s.materi_diskusi }}
    </p>
    <div v-if="forDashboard" class="">
      <i class="fa-solid fa-users text-primary mr-2"></i>
      <button v-for="(u, j) in s.users" :key="j" class="badge my-1">
        {{ u.name }}
      </button>
    </div>
    <div v-else>
      <i class="fa-solid fa-users text-primary mr-2"></i>
      <button
        v-for="(u, j) in s.users"
        :key="j"
        class="badge my-1"
        @click="chooseUser(u.id)"
      >
        {{ u.name }}
      </button>
    </div>
    <slot></slot>
  </div>
</template>