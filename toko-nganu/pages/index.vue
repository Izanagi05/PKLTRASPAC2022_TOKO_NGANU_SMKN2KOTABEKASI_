<template>
  <div>
    <div class="ppp">
      <div class="contact white--text">
        <div class="contact-text font-weight-regular">
          <button class="kontak" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
      <div class="container pb-3">
        <v-row>
          <v-col
            class="d-flex col-12 col-lg-6 col-md-4 col-sm-12 col-xs-12 d-flex align-center"
          >
            <v-img
              :src="require('~/assets/logo_nganu.png')"
              max-width="40"
            ></v-img>
            <div class="font-weight-bold text-h5 ml-4">Toko nganu</div>
          </v-col>
          <v-col
            class="d-flex col-12 col-lg-6 col-md-8 col-sm-12 col-xs-12 justify-end"
          >
            <div flat class="rounded-pill" color="#d9d9d9">
              <v-text-field
                class="nyari rounded-pill"
                v-model="cari"
                label="Cari Nganu"
                single-line
                hide-details
                outlined
                @keyup.enter="getsearchbarang()"
                append-icon="mdi-magnify"
                placehoder="cari"
              ></v-text-field>
            </div>
            <nuxt-link to="/keranjang" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab color="d9d9d9" icon
                ><v-icon size="29px">mdi-cart</v-icon></v-btn
              >
            </nuxt-link>
            <nuxt-link to="/user-view" class="text-decoration-none ml-2">
              <v-btn elevation="2" fab icon color="d9d9d9">
                <v-avatar class="foto-profilan">
                  <img
                    :src="
                      'http://127.0.0.1:8000/storage/' +
                      $cookies.get(`cookieku`).data.foto_profil
                    "
                  />
                </v-avatar>
              </v-btn>
            </nuxt-link>
            <div class="display-5 my-auto ml-2 font-weight-bold text-truncate">
              {{ $cookies.get("cookieku").data.nama }}
            </div>
          </v-col>
        </v-row>
      </div>
    </div>

    <div class="all-home">
      <div class="container">
        <div class="home-image">
          <div v-if="firstLoad" class="custom-skeleton">
            <v-skeleton-loader
              :loading="loading"
              type="image"
              height="390"
            ></v-skeleton-loader>
          </div>
          <v-carousel
            v-else
            no-autoplay
            height="auto"
            hide-delimiter-background
            show-arrows-on-hover
            class="object-fit-cover"
          >
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
            >
            </v-carousel-item>
          </v-carousel>
        </div>
        <div>
          <div v-if="firstLoad" class="d-flex mt-8">
            <v-skeleton-loader
              v-for="(ktg, index) in allkategori"
              :key="index"
              class="ma-2"
              :loading="loading"
              max-width="120"
              type="button"
            ></v-skeleton-loader>
          </div>

          <div v-else class="d-flex mt-8">
            <v-btn
              v-if="!loading"
              outlined 
              @click="getallbarang()"
              :class="
                fcek === true
                  ? 'ma-2 rounded-xl warnaku white--text'
                  : 'ma-2 rounded-xl'
              " 
              @click="getkategori(-1)"
              :class="[
                'ma-2  rounded-xl text-capitalize',
                fcek === true ? 'btn-warnaku white--text' : '',
              ]" 
            >
              Semua Kategori
            </v-btn>
            <v-btn
              outlined
              v-for="(ktg, index) in allkategori"
              :class="[
                'ma-2  rounded-xl text-capitalize',
                ktg.kategori_id === fcek ? 'btn-warnaku white--text' : '',
              ]"
              :key="index" 
              @click="getkategori(ktg)"
              :class="
                ktg === fcek
                  ? 'ma-2 rounded-xl warnaku white--text'
                  : 'ma-2 rounded-xl'
              " 
              @click="getkategori(ktg.kategori_id)"
              class="ma-2 rounded-xl" 
            >
              {{ ktg.nama }}
            </v-btn>
          </div>
        </div>
        <div>
          <div v-if="firstLoad">
            <v-skeleton-loader
              :loading="loading"
              width="500"
              type="heading"
            ></v-skeleton-loader>
          </div>

          <div v-else>
            <div class="font-weight-bold text-h6">Rekomendasi Untuk Kamu</div>
          </div>
        </div>
 
        <div>
          <div class="product-card">
            <div v-if="set == 0">
              <v-row class="p-0">
                <v-col
                  cols="5"
                  :class="[
                    '   mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ',
                    $vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',
                  ]"
                  v-for="(brg, index) in allbarang"
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
                            <span class="ml-2">{{ brg.toko?.nama }}</span>
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
            <div class="tampil3" v-if="set == 2">
              <v-row class="p-0">
                <v-col
                  cols="5"
                  :class="[
                    'mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ',
                    $vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',
                  ]"
                  v-for="(brg, index) in hasilcari.data"
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
                            <span class="ml-2">{{ brg.toko?.nama }}</span>
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
            <div class="tampil2" v-if="set == 1">
              <v-row
                class="p-0"
                v-for="(brg, index) in hasilKategori"
                :key="index"
              >
                <v-col
                  cols="5"
                  :class="[
                    '   mt-4   col-md-4  col-sm-6 col-xs-6 d-flex justify-center  ',
                    $vuetify.breakpoint.lgAndUp ? 'col-lg-5' : '',
                  ]"
                  v-for="(barang, index) in brg.barang"
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
                      v-for="(ft, i) in barang.barang_foto_first"
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
                        {{ barang.nama }}
                      </div>
                      <div
                        class="font-weight-medium d-flex"
                        v-for="(vrn, i) in barang.barang_varian_first"
                        :key="i"
                      >
                        <div v-if="barang" class="mr-1">Rp</div>
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
                            <span class="ml-2">{{ barang.toko?.nama }}</span>
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
                @click="todetail(brg)"
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
                          :src="require('~/assets/pajamas_tanuki-verified.png')"
                          max-width="16"
                        ></v-img>
                        <span class="ml-2">{{ brg.toko?.nama }}</span>
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
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Footer from "~/components/Footer.vue";
export default {
  middleware: "middlewareku",
  data() {
    return { 
      rating: 3.5,
      firstLoad: true,
      set: 0,
      cari: null,
      fcek: null, 
      set: 0,
      cari: null,
      fcek: null,
      rating: 3.5,
      currentRating: 0,
      firstLoad: true,
      loading: true, 

      hasilcari: [],
      no_admin: "6281563151038",
      nama: null,
      tokouser: null,
      Toko: null,
      barangparam: null,
      allbarang: {
        barang_id: "",
      },
      allkategori: {
        kategori_id: "",
      },
      getdataallcheck: -1,
      getdataall: [],
      items: [
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
        {
          src: "home-img.png",
        },
      ],
    };
  },
  methods: {
    search() {
 
      console.log("ets" + this.searchteks);
    },
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
    gettoko() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
        .then((respon) => {
          this.Toko = respon.data?.data;
        });
 
    },
    getallbarang() {
      axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.allbarang = respon.data?.data;
      });
      this.set = 0;
      this.fcek = true;
    },
    getsearchbarang() {
      axios
        .get("http://127.0.0.1:8000/api/search/" + this.cari)
        .then((respon) => {
          this.hasilcari = respon.data?.data;
          console.log(respon.data?.data);
        }); 
    },
    getsearchbarang() {
 
      this.set = 2;
    },
    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.allkategori = respon.data?.data;
      });
    },
    getkategori(ktg) {
 
      axios
        .get(`http://127.0.0.1:8000/api/getkategori/${ktg.kategori_id}`)
        .then((respon) => {
          console.log(respon.data?.data);
          this.hasilKategori = respon.data?.data;
        });
      this.set = 1;
      this.fcek = ktg;
 
      this.getdataallcheck = ktg;
      if (this.getdataallcheck == -1) {
        axios
          .get("http://127.0.0.1:8000/api/getallbarangtoko")
          .then((respon) => {
            this.getdataall = respon.data?.data;
            console.log(this.getdataall);
          });
        this.fcek = true;
      } else if (this.getdataallcheck >= 0) {
        axios
          .get(`http://127.0.0.1:8000/api/getkategori/${ktg}`)
          .then((respon) => {
            this.getdataall = respon.data?.data[0]?.barang;
          });
        this.fcek = ktg;
      } else if (this.getdataallcheck == -2) {
        axios
          .get("http://127.0.0.1:8000/api/search/" + this.cari)
          .then((respon) => {
            this.getdataall = respon.data?.data;
            console.log(this.getdataall);
          });
      }
 
    },
    todetail(brg) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${brg.barang_id}`);
    },
    todetail2(barang) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${barang.barang_id}`);
    },
  },
 
  mounted() {
    setTimeout(() => {
      this.firstLoad = false;
      this.loading = false;
    }, 3000);
  },
 

  created() {
    const userid = this.$cookies.get("cookieku");
    this.nama = userid.data.nama;
    console.log(userid);
    this.tokouser = userid.data.id;
    this.gettoko();
    this.getallkategori();
    this.getkategori(-1);
    this.getsearchbarang();
 
    this.getallbarang();
  },
  mounted() {
    setTimeout(() => {
      this.firstLoad = false;
      this.loading = false;
    }, 3000);
 
    // this.getallbarang();
 
  },
};
</script>
<style scoped>
.custom-skeleton {
  height: 100%;
}

.custom-skeleton ::v-deep .v-skeleton-loader > * {
  height: 100%;
  display: flex;
  flex-direction: column;
}
.col-5 {
  flex: 0 0 20%;
  max-width: 20%;
}

.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}

.ppp {
  overflow: hidden;
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}

.image-cont {
  height: 200px;
  overflow: hidden;
}

.image-cont img {
  object-fit: cover;
  object-position: center;
}

.col-lg-5 {
  flex: 0 0 20%;
  max-width: 20%;
}
</style>
