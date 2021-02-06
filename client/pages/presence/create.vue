<template>
  <card title="Absen Pegawai">
    <!-- <h5>Terdapat {{ count }} data pegawai</h5> -->
    <form @submit.prevent="save">
      Tanggal : {{ currentDate }}
      <br />
      Waktu : {{ currentTime }}
      <br />
      <button class="btn btn-info" :disabled="loading">Simpan Presensi</button>
    </form>
  </card>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  middleware: "auth",

  head() {
    return { title: "Absensi Pegawai" };
  },

  async asyncData(content) {},

  data() {
    return {
      form: {
        timezone: "",
        latitude: "",
        longitude: "",
      },
      currentDate: null,
      currentTime: null,
      loading: false,
    };
  },
  methods: {
    updateDate() {
      let today = new Date();
      this.currentDate =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1 + "").padStart(2, "0") +
        "-" +
        (today.getDate() + "").padStart(2, "0");

      setTimeout(() => {
        this.updateDate();
      }, 1000 - new Date().getMilliseconds);
    },
    updateTime() {
      let today = new Date();
      this.currentTime =
        today.getHours() +
        ":" +
        (today.getMinutes() + "").padStart(2, "0") +
        ":" +
        (today.getSeconds() + "").padStart(2, "0");

      setTimeout(() => {
        this.updateTime();
      }, 1000 - new Date().getMilliseconds);
    },
    async getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          this.form.longitude = position.coords.longitude;
          this.form.latitude = position.coords.latitude;
        });
      } else {
        this.form.longitude = 0;
        this.form.latitdue = 0;
      }
    },

    async save() {
      this.loading = true;
      let res = (await axios.post("presence", this.form)).data;
      this.loading = false;
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Data berhasil disimpan",
        confirmButtonText: "ok",
      });
      this.form.name = "";
      this.form.date_of_birth = "";
      this.form.job_title = "";
    },
  },
  created() {
    this.getLocation();
    this.form.timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    this.updateTime();
    this.updateDate();
  },
};
</script>
