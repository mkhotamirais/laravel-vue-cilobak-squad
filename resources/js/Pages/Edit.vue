<script setup>
import { useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import TextArea from "@/Components/TextArea.vue";
import { institusi } from "../functions";

const props = defineProps({ schedule: Object, users: Object });
console.log(props.schedule);

const form = useForm({
  mata_pelajaran: props.schedule.mata_pelajaran || null,
  // tanggal: props.schedule.tanggal
  //   ? new Date(props.schedule.tanggal).toISOString().slice(0, 16)
  //   : null,
  tanggal: props.schedule.tanggal || null,
  institusi: props.schedule.institusi || null,
  users: props.schedule.users ? props.schedule.users.map((u) => u.id) : [],
  materi_diskusi: props.schedule.materi_diskusi || null,
  _method: "PATCH",
});
</script>

<template>
  <section class="py-4">
    <div class="container">
      <div class="bg-white dark:bg-dark-2 shadow-sm rounded-md p-4 max-w-lg">
        <h1 class="h1 mb-4">Ubah Jadwal</h1>

        <form
          @submit.prevent="form.post(route('jadwal.update', props.schedule.id))"
        >
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
          <div class="mb-4">
            <v-select
              id="institusi"
              :options="institusi"
              :reduce="(institusi) => institusi.value"
              v-model="form.institusi"
              placeholder="Pilih institusi"
            >
              <template #header>
                <div style="opacity: 0.8">Institusi</div>
              </template>
            </v-select>
            <p v-if="form.errors.institusi" class="!text-danger">
              <small>{{ form.errors.institusi }}</small>
            </p>
          </div>
          <div class="mb-4">
            <v-select
              id="users"
              :options="users"
              :reduce="(user) => user.value"
              v-model="form.users"
              multiple
              placeholder="Pilih peserta"
            >
              <template #header>
                <div style="opacity: 0.8">Peserta</div>
              </template>
            </v-select>
            <p v-if="form.errors.users" class="!text-danger">
              <small>{{ form.errors.users }}</small>
            </p>
          </div>

          <div class="flex items-center gap-2 mt-4">
            <button type="submit" class="btn w-fit" :disabled="form.processing">
              Simpan
            </button>
            <Link :href="route('home')" class="btn !bg-gray-600">Kembali</Link>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>