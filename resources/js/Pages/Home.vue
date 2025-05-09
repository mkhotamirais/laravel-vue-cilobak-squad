<script setup>
import SessMsg from "@/Components/SessMsg.vue";
import PaginationInput from "@/Components/PaginationInput.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { formatTanggal } from "@/functions";

const props = defineProps({
  schedules: Object,
  msg: String,
  searchTerm: String,
  institusiTerm: String,
  pesertaTerm: String,
});

const params = route().params;
const page = usePage();
const user = computed(() => page.props.auth.user);

const deleteSchedule = (id) => {
  if (confirm("Yakin ingin hapus?")) {
    router.delete(route("jadwal.destroy", id));
  }
};

const formSearch = { search: props.searchTerm };
const formInstitusi = { institusi: props.institusiTerm };

const search = () => {
  router.get(route("home"), {
    search: formSearch.search || null,
    institusi: props.institusiTerm || null,
    peserta: props.pesertaTerm || null,
  });
};

const selectInstitusi = () => {
  router.get(route("home"), {
    institusi: formInstitusi.institusi,
    search: props.searchTerm || null,
    peserta: props.pesertaTerm || null,
  });
};

const chooseInstitusi = (e) => {
  router.get(route("home"), {
    institusi: e,
    search: props.searchTerm || null,
    peserta: props.pesertaTerm || null,
  });
};

const choosePeserta = (e) => {
  router.get(route("home"), {
    peserta: e,
    institusi: props.institusiTerm || null,
    search: props.searchTerm || null,
  });
};
</script>

<template>
  <section class="">
    <div class="sticky top-16 bg-light dark:bg-dark py-4">
      <div
        class="container grid grid-cols-2 sm:flex gap-2 items-center justify-end"
      >
        <form @change.prevent="selectInstitusi">
          <select
            name="institusi"
            id="institusi"
            class="h-10 border px-2 border-primary bg-light dark:bg-dark rounded-md w-full sm:w-56"
            v-model="formInstitusi.institusi"
          >
            <option :value="null">Semua Institusi</option>
            <option value="ptiq_h">PTIQ H</option>
            <option value="pku_b">PKU B</option>
            <option value="pku_p">PKU P</option>
            <option value="ptiq_g">PTIQ G</option>
          </select>
        </form>
        <form
          @submit.prevent="search"
          class="flex border rounded-md border-primary items-center h-10 w-auto sm:w-56"
        >
          <input
            type="search"
            class="px-3 py-2 focus:outline-none w-full h-full"
            placeholder="Search.."
            v-model="formSearch.search"
          />
          <button type="submit" class="w-12 h-full text-lg" title="Search">
            <i class="fa-solid fa-magnifying-glass text-primary"></i>
          </button>
        </form>
        <div v-if="searchTerm || institusiTerm || pesertaTerm">
          <button
            @click="
              router.get(route('home'), { ...params, search: null, page: null })
            "
            class="badge"
            v-if="searchTerm"
          >
            {{ searchTerm }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
          <button
            @click="
              router.get(route('home'), {
                ...params,
                institusi: null,
                page: null,
              })
            "
            class="badge uppercase"
            v-if="institusiTerm"
          >
            {{ institusiTerm.replace("_", " ") }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
          <button
            @click="
              router.get(route('home'), {
                ...params,
                peserta: null,
                page: null,
              })
            "
            class="badge"
            v-if="pesertaTerm"
          >
            {{ pesertaTerm }}
            <i class="fa-solid fa-times ml-1"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="container">
      <div v-if="user">
        <Link :href="route('jadwal.create')" class="btn w-fit mb-2">
          Create Schedule
        </Link>
        <SessMsg :msg="msg" />
      </div>

      <!-- Schedules -->
      <div v-if="schedules.data.length">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div
            v-for="(s, i) in schedules.data"
            :key="i"
            class="bg-white dark:bg-dark-2 shadow-sm rounded-md p-4 space-y-2"
          >
            <p>
              <i class="fa-solid fa-book text-primary mr-2"></i>
              {{ s.mata_pelajaran }}
            </p>
            <button
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
            <div v-if="s.peserta" class="">
              <i class="fa-solid fa-users text-primary mr-2"></i>
              <button
                v-for="(p, j) in s.peserta.split(',')"
                :key="j"
                class="badge my-1"
                @click="choosePeserta(p)"
              >
                {{ p }}
              </button>
            </div>
            <div v-if="user" class="flex gap-4 items-center">
              <Link
                :href="route('jadwal.edit', s.id)"
                class="text-green-500 hover:underline"
              >
                Edit
              </Link>
              <button
                @click="deleteSchedule(s.id)"
                class="text-red-500 hover:underline"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
        <div class="flex justify-center mt-4">
          <PaginationInput :paginator="schedules" />
        </div>
      </div>
      <p v-else class="text-center text-gray-500 mt-8">
        Hasil pencarian
        <span class="font-bold italic">{{ searchTerm }}</span> tidak ditemukan
      </p>
    </div>
  </section>
</template>