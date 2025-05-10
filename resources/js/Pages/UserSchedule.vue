<script setup>
import CardSchedule from "@/Components/CardSchedule.vue";

defineProps({
  user: Object,
  schedules: Object,
  userTerm: String,
  searchTerm: String,
  institusiTerm: String,
});
</script>

<template>
  <section class="py-4">
    <div class="container">
      <h1 class="h1 mb-4">
        Jadwal <span class="text-primary">{{ user.name }}</span>
      </h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <template v-for="(s, i) in schedules.data" :key="i">
          <CardSchedule
            :s="s"
            :userTerm="userTerm"
            :searchTerm="searchTerm"
            :institusiTerm="institusiTerm"
            :forDashboard="true"
          />
        </template>
      </div>
    </div>
  </section>
</template>