<template>
  <div>
    <Navbar />

    <v-container
      ><div
        class="mb-2 tes"
        v-for="(dtlbrg, index) in detailbarang"
        :key="index"
      >
        <NuxtLink to="/" class="my-2 text-decoration-none black--text">
          Home </NuxtLink
        ><span class="mdi mdi-chevron-right"
          ><b>{{ dtlbrg.nama }}</b></span
        >
      </div>
      <div class="content" v-for="(dtlbrg, index) in detailbarang" :key="index">
        <v-row>
          <v-col cols="4">
            <div class="foto-produk pt-4 pb-4" style="margin-left: 35px">
              <v-carousel
                no-autoplay
                height="380"
                width="380"
                hide-delimiter
                show-arrows-on-hover
                class="object-fit-cover"
              >
                <v-carousel-item
                  v-for="(ft, index) in allfotobybrgid"
                  :key="index"
                >
                  <v-img
                    contain
                    :src="'http://127.0.0.1:8000/storage/' + ft.file"
                    width="auto"
                    height="380"
                  ></v-img>
                </v-carousel-item>
              </v-carousel>
            </div>
          </v-col>
          <v-col cols="6" style="overflow-y: scroll; max-height: 1000px">
            <div class="detail pt-4">
              <div class="nama-barang font-weight-bold" style="font-size: 30px">
                {{ dtlbrg.nama }}
              </div>
              <v-row align="center">
                <v-col cols="auto">
                  <div>
                    <span>Rp{{ hargaVarianTerpilih }}</span>
                  </div>
                </v-col>
              </v-row>

              <div class="d-flex mt-8">
                <v-btn
                  v-for="(varian, index) in dtlbrg.barang_varian"
                  :key="index"
                  outlined
                  :color="pilihan === varian.varian_id ? 'green' : 'grey'"
                  class="mr-2 rounded-lg text-capitalize"
                  @click="pilihanvarian(varian)"
                  ><v-img
                    :src="
                      'http://127.0.0.1:8000/storage/' +
                      varian.foto_barang_varian
                    "
                    width="20"
                    height="auto"
                    class="mr-2"
                  ></v-img
                  >{{ varian.nama }}</v-btn
                >
              </div>
              <div class="pt-2">
                {{ dtlbrg.deskripsi }}
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
                <p>Selengkapnya...</p>
              </div>
            </div> </v-col
          ><v-col cols="2">
            <div class="button">
              <div>
                <div class="d-flex text-capitalize pb-2">
                  <div>
                    <v-img
                      :src="'http://127.0.0.1:8000/storage/' + fotosetvar"
                      width="50"
                      height="auto"
                    ></v-img>
                  </div>
                  <p class="ml-3 mt-3">{{ namasetvar }}</p>
                </div>
                <div class="d-flex">
                  <v-card class="d-flex align-center rounded-xl" outlined>
                    <v-btn
                      depressed
                      @click="countmin(dataa)"
                      :disabled="jumlahBarangDibeli === 1"
                      class="ma-2 rounded-xl"
                      small
                      icon
                    >
                      <v-icon>mdi-minus</v-icon>
                    </v-btn>
                    {{ jumlahBarangDibeli }}
                    <v-btn
                      depressed
                      @click="countplus(dataa)"
                      class="ma-2 rounded-xl pluskuantitas"
                      small
                      icon
                    >
                      <v-icon>mdi-plus</v-icon>
                    </v-btn>
                  </v-card>
                  <div class="pl-2 pt-3">
                    <p>Stok: {{ stokVarianTerpilih }}</p>
                  </div>
                </div>

                <p>Subtotal: Rp{{ subtotal }}</p>
              </div>

              <div class="tambah-troli">
                <v-btn
                  class="rounded-lg d-block text-capitalize"
                  large
                  outlined
                  width="100%"
                  @click="tambahkeranjang(dtlbrg)"
                  >Tambah <span class="mdi mdi-cart-outline"></span
                ></v-btn>
              </div>
              <div
                class="beli-sekarang pt-2"
                v-for="(belisekarangData, index) in detailbarang"
                :key="index"
              >
                <v-btn
                  class="rounded-lg d-block text-capitalize"
                  width="100%"
                  large
                  outlined
                  @click="transaksi(dtlbrg)"
                  style="background: #2f432d; color: white; size: 105px"
                  >Beli Sekarang</v-btn
                >
              </div>
            </div></v-col
          >
        </v-row>

        <div class="rekomendasi pb-6 item-center" style="margin-left: 35px">
          <div>
            <div class="product-card">
              <v-row class="p-0">
                <v-col
                  cols="5"
                  :class="[
                    '   mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ',
                    $vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',
                  ]"
                  v-for="(brg, index) in getdataall"
                  :key="index"
                >
                  <v-skeleton-loader
                    v-if="firstLoad"
                    width="300"
                    type="card, list-item-three-line"
                  />
                  <v-card
                    v-else
                    color="#ffffff"
                    class="rounded-lg"
                    elevation="1"
                    width="300"
                  >
                    <div
                      v-for="(ft, i) in brg.barang_foto_first"
                      :key="i"
                      max-width="100"
                      class="image-cont d-flex justify-center align-center"
                    >
                      <img
                        :src="'http://127.0.0.1:8000/storage/' + ft.file"
                        object-fit="cover"
                        width="100%"
                        height="100%"
                      />
                    </div>
                    <div class="pa-4">
                      <div class="font-weight-medium text-capitalize">
                        {{ brg.nama }}
                      </div>
                      <div
                        class="font-weight-medium d-flex"
                        v-for="(vrn, i) in brg.barang_varian_first"
                        :key="i"
                      >
                        <div v-if="brg" class="mr-1">Rp</div>
                        {{ vrn.harga }}
                      </div>
                      <v-row align="center">
                        <v-col cols="auto">
                          <div class="d-flex align-center">
                            <v-img
                              :src="
                                require('~/assets/pajamas_tanuki-verified.png')
                              "
                              max-width="16"
                            ></v-img>
                            <span class="ml-2">{{ brg.toko.nama }}</span>
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card mt-2 pb-1">
                        <v-rating
                          v-model="rating"
                          background-color="white"
                          color="yellow accent-4"
                          dense
                          half-increments
                          hover
                          size="18"
                        ></v-rating>
                      </div>
                    </div>
                  </v-card>
                </v-col>
              </v-row>
            </div>
          </div>
        </div></div
    ></v-container>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      detailbarang: [],
      userid: null,
      allfotobybrgid: [],
      firstLoad: true,
      loading: true,
      getdataall: [],
      rating: 3.5,
      dialog: false,

      detbarker: {
        user_id: "",
        barang_id: 1,
        kuantitas: 1,
        varian_id: 1,
        kategori_id: 1,
        toko_id: 1,
      },
      Toko: [],
      gettk: "",
      pilihan: null,
      setpil: 0,
      fotosetvar: "",
      namasetvar: "",

      stokVarianTerpilih: null,
      hargaVarianTerpilih: null,
      jumlahBarangDibeli: 1,
      subtotal: null,
    };
  },
  methods: {
    getdata() {
      axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.getdataall = respon.data?.data;
        console.log(this.getdataall);
      });
    },
    getbarangtokobyid() {
      axios
        .get(
          "http://127.0.0.1:8000/api/getbarangvariantokobyid/" +
            this.prm.barang_id
        )
        .then((respon) => {
          this.detailbarang = respon.data?.data;
          this.pilihan = this.detailbarang[0].barang_varian[0].varian_id;
          this.namasetvar = this.detailbarang[0].barang_varian[0].nama;
          this.stokVarianTerpilih = this.detailbarang[0].barang_varian[0].stok;
          this.subtotal = this.hargaVarianTerpilih * this.jumlahBarangDibeli;
          this.hargaVarianTerpilih =
            this.detailbarang[0].barang_varian[0].harga;
        });
    },
    getfotobyidbrg() {
      axios
        .get("http://127.0.0.1:8000/api/getfotobarang/" + this.prm.barang_id)
        .then((respon) => {
          this.allfotobybrgid = respon.data?.data;
        });
    },
    pilihanvarian(varian) {
      this.pilihan = varian.varian_id;
      this.namasetvar = varian.nama;
      this.fotosetvar = varian.foto_barang_varian;
      this.stokVarianTerpilih = varian.stok;
      this.hargaVarianTerpilih = varian.harga;
      this.$toasted.success("varian pilihan : " + this.namasetvar, {
        position: "top-right",
        className: "edit-toast",
        duration: 3000,
      });
    },
    tambahkeranjang() {
      // console.log( this.detailbarang[0]?.kategori_id)
      (this.detbarker.user_id = this.userid),
        (this.detbarker.toko_id = this.detailbarang[0]?.toko_id),
        (this.detbarker.kategori_id = this.detailbarang[0]?.kategori_id),
        (this.detbarker.barang_id = this.prm.barang_id),
        (this.detbarker.kuantitas = 1),
        (this.detbarker.varian_id = this.pilihan);
      axios
        .post(
          "http://127.0.0.1:8000/api/addkeranjangbyuser/" + this.userid,
          this.detbarker
        )
        .then((respon) => {
          console.log(respon);
          this.$toasted.show("Berhasil ditambah", {
            theme: "success",
            position: "top-right",
            className: "edit-toast2",
            duration: 3000,
          });
        });
      console.log(this.pilihan);
    },
    countmin(dataa) {
      if (this.jumlahBarangDibeli > 1) {
        this.jumlahBarangDibeli--;
        this.subtotal = this.jumlahBarangDibeli * this.hargaVarianTerpilih;
      }
    },

    countplus(dataa) {
      if (this.jumlahBarangDibeli < this.stokVarianTerpilih) {
        this.jumlahBarangDibeli++;
        this.subtotal = this.jumlahBarangDibeli * this.hargaVarianTerpilih;
      } else {
        this.$toasted.error("Jumlah melebihi stok varian", {
          theme: "error",
          position: "top-right",
          className: "edit-toast2",
          duration: 3000,
        });
      }
    },
    transaksi(dtlbrg) {
      const detbarker = {
        user_id: this.userid,
        toko_id: dtlbrg.toko_id,
        barang_id: this.prm.barang_id,
        varian_id: this.pilihan,
        kategori_id: dtlbrg.kategori_id,
        jumlah: this.jumlahBarangDibeli,
        total_harga: this.subtotal,
      };

      axios
        .post("http://localhost:8000/api/createtransaksi", detbarker)
        .then((respon) => {
          console.log(respon.data);
        })
        .catch((error) => {
          console.error("Error while creating transaction:", error);
        });
    },
  },

  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getbarangtokobyid();
    this.getfotobyidbrg();
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
.edit-toast2 {
  background: rgb(5, 141, 5);
  color: white;
  padding: 10px;
  border-radius: 20px;
}
</style>
