<script setup>
import { useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import TextArea from "@/Components/TextArea.vue";

const form = useForm({
  mata_pelajaran: null,
  tanggal: null,
  peserta: null,
  materi_diskusi: null,
});

const submit = () => {
  form.post(route("jadwal.store"), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <section class="py-4">
    <div class="container">
      <div class="bg-white dark:bg-dark-2 shadow-sm rounded-md p-4 max-w-lg">
        <h1 class="h1 mb-4">Buat Jadwal</h1>

        <form @submit.prevent="submit">
          <Input
            label="Mata Pelajaran"
            icon="book"
            placeholder="Mata Pelajaran"
            id="mata_pelajaran"
            v-model="form.mata_pelajaran"
            :error="form.errors.mata_pelajaran"
          />
          <TextArea
            label="Materi Diskusi"
            icon="book-open"
            placeholder="Materi Diskusi"
            id="materi_diskusi"
            v-model="form.materi_diskusi"
            :error="form.errors.materi_diskusi"
          />
          <Input
            label="Tanggal"
            icon="calendar"
            placeholder="Tanggal"
            id="tanggal"
            type="datetime-local"
            v-model="form.tanggal"
            :error="form.errors.tanggal"
          />
          <Input
            label="Peserta (pisahkan dengan koma)"
            icon="users"
            placeholder="ahmad, abdul, siti"
            id="peserta"
            v-model="form.peserta"
            :error="form.errors.peserta"
          />

          <div class="flex items-center gap-2 mt-4">
            <button type="submit" class="btn w-fit" :disabled="form.processing">
              Create Schedule
            </button>
            <Link :href="route('home')" class="btn !bg-gray-600">Kembali</Link>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>