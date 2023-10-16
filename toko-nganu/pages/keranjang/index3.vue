<template>
  <div style="height:100vh;">
    <Navbar />
    <div>
      <v-dialog v-model="dialogDelete" max-width="500px">
        <v-card>
          <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
              >Cancel</v-btn
            >
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="confirmhapuskeranjang"
              >OK</v-btn
            >
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-container class="cart">
        <v-row>
          <v-col cols="12" lg="8" md="8">
            <div class="">
              <v-row>
                <v-col>
                  <div class="grey--text">Produk</div>
                </v-col>
                <v-col>
                  <div class="grey--text">Harga</div>
                </v-col>
                <v-col>
                  <div class="grey--text">Jumlah</div>
                </v-col>
                <v-col>
                  <div class="grey--text">Total</div>
                </v-col>
              </v-row>
              <v-row
                v-for="(dataa, index) in datakeranjang.user_keranjang"
                :key="index"
              >
                <v-col
                  cols="5"
                  lg="3"
                  md="3"
                  sm="4"
                  xs="4"
                  class="d-flex align-center"
                >
                  <v-img class="rounded-xl"
                    :src="require('~/assets/barang.png')"

                  ></v-img>
                  <div class="ml-2 font-weight-medium">
                    {{ namabarangker?.nama }}
                  </div>
                </v-col>
                <v-col cols="7"  lg="9"
                  md="9"
                  sm="8"
                  xs="8">
                  <v-row class="ma-0">
                  <v-col cols="6" lg="2" md="3" sm="6" xs="6" class="  order-1 order-lg-1">
                    <div class="font-weight-medium">
                      Rp. {{ varharga.harga }}
                    </div>
                  </v-col>
                  <v-col cols="6" lg="3" md="3" sm="6" xs="6" class="d-flex justify-end  order-4 order-lg-2 order-md-2">
                    <div
                      class="d-flex justify-center bg-greyku rounded-lg"
                      style="width: 60px"
                    >
                      <div v-if="dataa.kuantitas == 1">
                        <button @click="countmin(dataa)" disabled type="submit">
                          <v-icon color="AAAAAA">mdi-minus</v-icon>
                        </button>
                      </div>
                      <div v-else>
                        <button @click="countmin(dataa)" type="submit">
                          <v-icon color="black">mdi-minus</v-icon>
                        </button>
                      </div>

                      <div class="font-weight-medium">
                        {{ dataa.kuantitas }}
                      </div>
                      <button
                        class="pluskuantitas"
                        @click="countplus(dataa)"
                        type="submit"
                      >
                        <v-icon color="black">mdi-plus</v-icon>
                      </button>
                    </div>
                  </v-col>
                  <v-col cols="6" lg="2" md="2" sm="6" xs="6" class="  order-3 order-lg-3">
                    <div class="font-weight-medium">
                      Rp. {{ totalprice.harga }}
                    </div>
                  </v-col>
                  <!-- </div> -->
                  <v-col cols="6" lg="1" md="1" sm="6" xs="6" class="d-flex justify-end  order-2 order-lg-4 order-md-4">
                    <div>
                      <!-- <v-btn fab color="#ffffff" small text depressed -->
                        <v-icon color="#bdbdbd" @click="hapuskeranjang(dataa)">mdi-delete</v-icon>
                        <!-- </v-btn> -->
                    </div>
                  </v-col>

                </v-row>
                </v-col>
              </v-row>
            </div>
          </v-col>
          <v-col cols="12" lg="4" md="4" class="d-flex justify-center">
            <v-col cols="10" class="total-detail ">
              <v-card  :class="['grey lighten-3 pa-4',$vuetify.breakpoint.xs?'smCheckoutBox rounded-t-xl':' rounded-xl ']">

                <div class="text-h6 font-weight-bold">Rincian Order</div>
                <div class="line grey mb-2"></div>
              <div
                class="d-flex grey--text font-weight-medium justify-space-between"
              >
                Jumlah
                <div class="font-weight-medium black--text">
                  {{ kuan }}
                </div>
              </div>
              <div
                class="d-flex grey--text justify-space-between grey--text font-weight-medium"
              >
                Harga
                <div class="font-weight-medium black--text" v-if="varharga">
                  {{ varharga.harga }}
                </div>
              </div>
              <div class="line grey my-2"></div>
              <div
                class="d-flex grey--text font-weight-medium justify-space-between"
              >
                Total Harga
                <div class="font-weight-medium black--text">
                  Rp. {{ totalprice.harga }}
                </div>
              </div>
              <div class="d-flex justify-center mt-8 px-8">
                <v-btn
                  width="100%"
                  class="text-capitalize px-8 text-body-1 font-weight-medium rounded-lg white--text"
                  @click="nomer()"
                  color="#2f432d"
                  type="submit"
                >
                  Checkout
                </v-btn>
              </div>
            </v-card>
            </v-col>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      dialogDelete: false,
      price: 100000,
      datakeranjangtb: [],
      headerkeranjang: [
        { text: "Produk", value: "" },
        { text: "Harga", value: "datakategori" },
        { text: "Jumlah", value: "datakategori" },
        { text: "Total", value: "datakategori" },
      ],
      varharga: {
        harga: 0,
        nama: "",
        stok: 0,
      },
      pricetotal: 0,
      getidker: null,
      kuan: 1,
      totalprice: {
        harga: 0,
      },
      namabarangker: {
        nama: "",
      },
      datakeranjang: {
        barang_id: "",
        kuantitas: "",
      },
      // editedIndex:0,
      detaildatadialog: {
        keranjang_user_id: "",
        barang_id: "",
        kuantitas: "",
      },
      userid: null,
      no_admin: "+62-815-6315-1038",
      tesbarang: null,
    };
  },
  methods: {
    inisialisasidataker() {
      //   this.datakeranjangtb= [
      //     {keranjang: namabarangker?.nama},
      //     {keranjang: varharga.harga},
      //     {keranjang: namabarangker?.nama},
      //     {keranjang: namabarangker?.nama},
      // ]

      this.datakeranjangtb = [
        { prd: "Produk", hrg: "Harga", jml: "Jumlah", ttl: "Total" },
        {
          prd: this.namabarangker?.nama,
          hrg: this.varharga.harga,
          jml: this.data?.kuantitas,
          ttl: this.totalprice.harga,
        },
      ];
    },
    getkeranjang() {
      axios
        .get("http://127.0.0.1:8000/api/keranjangbyuser/" + this.userid)
        .then((respon) => {
          this.datakeranjang = respon.data;
        });
    },
    getharga() {
      axios
        .get("http://127.0.0.1:8000/api/getvarian/" + this.getidker.varian_id)
        .then((respon) => {
          this.varharga = respon.data?.data[0];
        });
      this.totalprice.harga = this.varharga.harga;
    },
    getbarangnama() {
      axios
        .get(
          "http://127.0.0.1:8000/api/getbarangtokobyid/" +
            this.getidker.barang_id
        )
        .then((respon) => {
          this.namabarangker = respon.data[0];
        });
    },
    getidkeranjang() {
      axios
        .get("http://127.0.0.1:8000/api/keranjanguser/" + this.userid)
        .then((respon) => {
          this.getidker = respon.data;
          this.getharga();
          this.getbarangnama();
        });
    },

    countplus(dataa) {
      if (dataa.kuantitas < this.varharga.stok) {
        dataa.kuantitas++;
      } else {
      }
      this.totalprice.harga =
        parseInt(dataa.kuantitas) * parseInt(this.varharga.harga);
      this.kuan = dataa.kuantitas;
    },
    countmin(dataa) {
      dataa.kuantitas -= 1;
      this.kuan = dataa.kuantitas;
      this.totalprice.harga =
        parseInt(this.totalprice.harga) - parseInt(this.varharga.harga);
    },
    hapuskeranjang(item) {
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
      // console.log(this.editedIndex);
    },
    confirmhapuskeranjang() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletekeranjang/" +
            this.detaildatadialog.keranjang_user_id
        )
        .then((respon) => {
          console.log(respon);
          location.reload();
          // alert("berhasil hapus");
          this.$toasted.show("Berhasil hapus keranjang", {
            theme: "success",
            position: "top-right",
            className: "edit-toast",
            duration: 3000,
          });
        });
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedIndex = -1;
      });
    },

    nomer() {
      let no = this.no_admin;
      let pesan =
        "Hi!%20Saya%20ingin%20memesan%20" +
        this.namabarangker?.nama +
        " dengan%20varian%20" +
        this.varharga?.nama +
        "%20seharga%20Rp." +
        this.totalprice?.harga;
      window.open(
        "https://api.whatsapp.com/send?phone=" + no + "&text=" + pesan
      );
    },
    transaksi() {
      console.log("tes");
    },
  },
  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getkeranjang();
    this.getidkeranjang();
    this.inisialisasidataker();
  },
};
</script>
<style scoped>
.edit-toast {
  background: green;
  color: white;
  padding: 10px;
  border-radius: 20px;
}
.line {
  width: 100%;
  height: 1px;
}
.smCheckoutBox{
    z-index: 100;
    position: fixed;
    width: 100vw;
    left: 0;
    bottom: 0;
}
</style>
