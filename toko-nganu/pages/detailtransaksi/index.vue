<template>
  <div>
    <Navbar />
    <div class="container">
      <v-card
        v-for="(dt, i) in alldatadetailtransakasi"
        :key="i"
        class="pa-6 ma-2"
      >
        <div class="d-flex justify-space-between mb-4">
          <div class="d-flex align-center">
            <p class="ma-0 text-body-2 grey--text">Toko</p>
            <p class="ma-0 ml-2 text-body-1 font-weight-medium">
              {{ dt.nama_toko }}
            </p>
          </div>
          {{ dt.tgl_transaksi }}
        </div>
        <v-row>
          <v-col cols="12" class="d-flex justify-space-between mb-2">
            <div class="">
              <p class="ma-0 text-body-2 grey--text">status</p>
              <p class="ma-0 font-weight-medium text-h6">
                {{ dt.status }}
              </p>
            </div>
            <div class="">
              <p class="ma-0 text-body-2 grey--text">subtotal</p>
              <p class="ma-0 font-weight-bold text-h5">
              Rp. {{ dt.subtotal }}
              </p>
            </div>
          </v-col>
          <v-col>
            <p class="ma-0 text-body-2 grey--text">Barang</p>
            <p class="ma-0 text-body-1 font-weight-medium">
              {{ dt.nama_barang }}
            </p>
          </v-col>
          <v-col>
            <p class="ma-0 text-body-2 grey--text">Kategori</p>
            <p class="ma-0 text-body-1 font-weight-medium">
              {{ dt.nama_kategori }}
            </p>
          </v-col>
          <v-col>
            <p class="ma-0 text-body-2 grey--text">Varian</p>
            <p class="ma-0 text-body-1 font-weight-medium">
              {{ dt.nama_varian }}
            </p>
          </v-col>
          <v-col>
            <p class="ma-0 text-body-2 grey--text">Jumlah dibeli</p>
            <p class="ma-0 text-body-1 font-weight-medium">{{ dt.jumlah }}</p>
          </v-col>
        </v-row>
      </v-card>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      alldatadetailtransakasi: [],
    };
  },

  methods: {
    getalldetailtransakasi() {
      axios
        .get(
          "http://localhost:8000/api/getdatadetailtransakasibyuser/" +
            this.userid
        )
        .then((respon) => {
          this.alldatadetailtransakasi = respon.data?.data;
        });
    },
  },
  created() {
    const userid = this.$cookies.get("cookieku");
    this.userid = userid.data.id;
    this.getalldetailtransakasi();
  },
};
</script>
