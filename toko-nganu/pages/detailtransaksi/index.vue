<template>
  <div>
    <Navbar />
    <div class="container">
      <v-card
        v-for="(dt, i) in alldatadetailtransakasi"
        :key="i"
        class="pa-6 ma-2 rounded-lg"
        @click="openDialog(dt)"
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
              <p class="ma-0 font-weight-bold text-h5">Rp. {{ dt.subtotal }}</p>
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
            <p class="ma-0 text-body-1 font-weight-medium">
              {{ dt.jumlah }}
            </p>
            
          </v-col>
          <!-- <v-col>
          </v-col> -->
        </v-row>
      </v-card>
    </div>
    <v-dialog v-model="dialog" max-width="400">
      <v-card class="rounded-lg">
        <v-card-title>Isi Rating</v-card-title>
        <v-card-text>
          <!-- <v-text-field v-model="newRating" label="Rating" type="number" /> -->
          <v-rating
                        v-model="newRating"
                        background-color="yellow"
                        color="yellow accent-4"
                        dense
                        half-increments
                        hover
                        size="18"
                      ></v-rating>
        </v-card-text>
        <v-card-actions>
          <v-btn color="#2f432d" rounded-lg class="white--text text-capitalize" @click="submitRating">Submit</v-btn>
          <v-btn outlined rounded-lg @click="closeDialog" class="text-capitalize">Batal</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      alldatadetailtransakasi: [],
      dialog: false,
      newRating: 0,
      selectedTransaction: null,
    };
  },

  methods: {
    openDialog(transaction) {
      this.selectedTransaction = transaction;
      this.dialog = true;
    },
    closeDialog() {
      this.dialog = false;
    },
    submitRating() {
      const ratingData = {
        barang_id: this.selectedTransaction.barang_id,
        user_id: this.selectedTransaction.user_id,
        rating: this.newRating,
      };

      axios
        .post("http://127.0.0.1:8000/api/createrating", ratingData)
        .then((response) => {
          console.log("Rating terkirim!");
        })
        .catch((error) => {
          console.error("Gagal mengirim rating:", error);
        });

      this.closeDialog();
    },
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
