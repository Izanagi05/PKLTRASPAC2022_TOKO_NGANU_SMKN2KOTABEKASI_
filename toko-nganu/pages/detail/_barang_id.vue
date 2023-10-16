<template>
  <div>
    <Navbar />

    <v-container
      ><div class="navigasi ml-6">
        <v-breadcrumbs :items="items">
          <template v-slot:divider>
            <v-icon>mdi-chevron-right</v-icon>
          </template>
        </v-breadcrumbs>
      </div>
      <div class="content" v-for="(dtlbrg, index) in detailbarang" :key="index">
        <v-row>
          <v-col>
            <div class="foto-produk pt-4 pb-4" style="margin-left: 35px">
              <v-row>
                <v-col cols="6">
                  <v-carousel
                    no-autoplay
                    height="auto"
                    hide-delimiter-background
                    show-arrows-on-hover
                    class="object-fit-cover"
                  >
                    <v-carousel-item
                      v-for="(ft, index) in allfotobybrgid"
                      :key="index"
                    >
                      <v-img
                        :src="'http://127.0.0.1:8000/storage/' + ft.file"
                        width="500px"
                      ></v-img>
                    </v-carousel-item>
                  </v-carousel>
                </v-col>
              </v-row>
            </div>
          </v-col>
          <v-col>
            <div class="detail pt-4">
              <div class="nama-barang font-weight-bold" style="font-size: 30px">
                {{ dtlbrg.nama }}
              </div>
              <v-row align="center">
                <v-col cols="auto">
                  <div>
                    <span class="ml-2">HARGA</span>
                  </div>
                </v-col>
              </v-row>
              Pilih Varian : {{ namasetvar }}
              <v-row>
                <v-col
                  v-for="(varian, index) in dtlbrg.barang_varian"
                  :key="index"
                >
                  <!-- <p>stok: {{ varian.stok }}</p>
                <p>harga {{ varian.harga }}</p> -->
                  <p></p>
                  <v-btn @click="pilihanvarian(varian)">{{
                    varian.nama
                  }}</v-btn>
                </v-col>
              </v-row>
            </div>
            <div class="button pb-4" style="padding-top: 200px">
              <v-row>
                <v-col cols="4">
                  <div class="tambah-troli pl-6">
                    <v-btn
                      class="rounded-pill"
                      x-large
                      outlined
                      @click="tambahkeranjang(dtlbrg)"
                      >Tambah <span class="mdi mdi-cart-outline"></span
                    ></v-btn>
                  </div>
                </v-col>
                <v-col cols="6">
                  <div
                    class="beli-sekarang"
                    v-for="(belisekarangData, index) in detailbarang"
                    :key="index"
                  >
                    <v-dialog v-model="dialog" persistent max-width="290">
                      <template v-slot:activator="{ on, attrs }">
                        <v-btn
                          v-bind="attrs"
                          v-on="on"
                          class="rounded-pill"
                          width="287px"
                          x-large
                          outlined
                          capitallize
                          style="background: #2f432d; color: white; size: 105px"
                          >Beli Sekarang</v-btn
                        >
                      </template>
                      <v-card>
                        <v-card-title class="text-h5">{{
                          belisekarangData.nama
                        }}</v-card-title>
                        <v-card-text>{{
                          belisekarangData.deskripsi
                        }}</v-card-text>
                        <div
                          v-for="(pc, index) in allfotobybrgid"
                          :key="index"
                          :src="belisekarangData.foto"
                          width="100%"
                        >
                          <v-img
                            v-if="'http://127.0.0.1:8000/storage/' + pc.file"
                            :src="'http://127.0.0.1:8000/storage/' + pc.file"
                          ></v-img>
                        </div>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn
                            color="green darken-1"
                            text
                            @click="dialog = false"
                          >
                            Disagree
                          </v-btn>
                          <v-btn
                            color="green darken-1"
                            text
                            @click="dialog = false"
                          >
                            Agree
                          </v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </div>
                </v-col>
              </v-row>
            </div>
          </v-col>
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
                        {{ vrn.harga | currency("id-ID", "IDR") }}
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
      items: [
        {
          text: "Home",
          disabled: false,
          href: "/",
        },
      ],
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
        toko_id: null,
        kategori_id: null,
        barang_id: null,
        kuantitas: null,
        varian_id: null,
      },
      Toko: [],
      gettk: "",
      pilihan: null,
      setpil: 0,
      namasetvar: "",
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
      this.$toasted.success("varian pilihan : " + this.namasetvar, {
        position: "top-right",
        className: "edit-toast",
        duration: 3000,
      });
    },
    tambahkeranjang() {
      // console.log( this.detailbarang[0]?.kategori_id)
      (this.detbarker.user_id = this.userid),
      (this.detbarker.toko_id =this.detailbarang[0]?.toko_id),
      (this.detbarker.kategori_id =this.detailbarang[0]?.kategori_id),
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
  },

  created() {
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getbarangtokobyid();
    this.getfotobyidbrg();
    if (this.detailbarang.nama) {
      this.items.push({
        text: this.detailbarang.nama,
        disabled: true,
        href: "breadcrumbs_link_1",
      });
    }
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
