<script setup>
const model = defineModel();
defineProps({
  label: String,
  icon: String,
  placeholder: { type: String, default: "" },
  error: String,
});
</script>

<template>
  <div class="mb-3">
    <label
      :for="label"
      class="block text-sm font-medium text-slate-700 dark:text-slate-300"
      >{{ label }}</label
    >
    <div class="relative mt-1 rounded-md">
      <div
        class="pointer-events-none absolute top-3 left-0 flex items-center pl-3"
      >
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${icon}`"></i>
        </span>
      </div>
      <textarea
        rows="6"
        :placeholder="placeholder"
        v-model="model"
        class="border block w-full rounded-md py-2 pr-3 pl-9 text-sm dark:text-slate-200 border-slate-300 outline-0 focus:ring-1 focus:ring-inset focus:ring-indigo-400 focus:border-indigo-400 plaholder:text-slate-400"
      ></textarea>
    </div>
    <p v-if="error" class="!text-danger">
      <small>{{ error }}</small>
    </p>
  </div>
</template>