<script setup>
const model = defineModel();
defineProps({
  label: String,
  id: String,
  icon: String,
  placeholder: { type: String, default: "" },
  type: { type: String, default: "text" },
  error: String,
});
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="text-sm font-medium mb-0.5">{{ label }}</label>
    <div class="relative rounded-md">
      <div
        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
      >
        <span class="grid place-content-center text-sm text-slate-400">
          <i :class="`fa-solid fa-${icon}`"></i>
        </span>
      </div>
      <input
        :type="type"
        :id="id"
        :placeholder="placeholder"
        v-model="model"
        class="border block w-full rounded-md py-2 pr-3 pl-9 text-sm dark:text-slate-200 border-slate-300 outline-0 focus:ring-1 focus:ring-inset focus:ring-indigo-400 focus:border-indigo-400 plaholder:text-slate-400"
      />
    </div>
    <p v-if="error" class="!text-danger">
      <small>{{ error }}</small>
    </p>
  </div>
</template>