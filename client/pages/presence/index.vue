<template>
  <card title="Daftar Pegawai">
    <div class="d-flex justify-content-between">
      <h5>Terdapat {{ count }} Data Presensi</h5>
      <router-link to="presence/create" class="btn btn-sm btn-info">
        Catat Presensi
      </router-link>
    </div>
    <div class="row mt-3">
      <div class="col-md-6">
        <select class="custom-select custom-select-sm" v-model="filterYear">
          <option selected disabled>Year</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
        </select>
      </div>
      <div class="col-md-6">
        <select class="custom-select custom-select-sm" v-model="filterMonth">
          <option selected disabled>Month</option>
          <option value="1">Janaury</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-12 mb-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Waktu Masuk</th>
              <th scope="col">Waktu Pulang</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="presence in presences" :key="presence.id">
              <td>{{ presence.date }}</td>
              <td>{{ presence.checkin_time }}</td>
              <td>{{ presence.checkout_time }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </card>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
  middleware: "auth",
  // meta: {
  //   permission: "employee.list",
  // },

  head() {
    return { title: "Absensi Pegawai" };
  },

  async asyncData(content) {
    let res = (await axios.get("presence")).data;
    let presences = res.data;
    let count = res.count;
    let filterYear = new Date().getFullYear();
    let filterMonth = new Date().getMonth() + 1;
    return {
      filterYear,
      filterMonth,
      presences,
      count,
    };
  },

  methods: {
    async refreshData() {
      let res = (
        await axios.get("presence", {
          params: {
            year: this.filterYear,
            month: this.filterMonth,
          },
        })
      ).data;
      this.presences = res.data;
    },
    deleteData(employee) {
      Swal.fire({
        title: "Apakah anda yakin ingin menghapus data ini?",
        text: `${employee.name}`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          let res = axios.delete(`employee/${employee.id}`).data;
          Swal.fire("Deleted!", "Data berhasil dihapus.", "success");
        }
      });
      this.$forceUpdate;
    },
  },
  watch: {
    filterYear(newVal) {
      this.refreshData();
    },
    filterMonth(newVal) {
      this.refreshData();
    },
  },
};
</script>
