<template>
  <div>
    <!-- <Navbar  /> -->
    <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <button class="kontak" type="submit" @click="kontak"  >

          <v-icon color="white">mdi-phone</v-icon>
          +62-815-6315-1038
        </button>
      </div>
    </div>
    <div class="nav">
      <div class="logo">
        <v-img :src="require('~/assets/logo_nganu.png')" width="100px"></v-img>
      </div>
      <div class="nama_toko">
        <div>Toko nganu</div>
      </div>
      <div flat class="rounded-pill search" color="#d9d9d9">
        <v-text-field
        class="nyari rounded-pill"
        v-model="cari"
          label="Cari Nganu"
          single-line
          hide-details
          outlined
          @keyup.enter="getsearchbarang()"
          append-icon="mdi-magnify"
          placehoder="search"

        ></v-text-field>
      </div>
      <div class="profile_icon_keranjang">
        <nuxt-link to="/keranjang" class="text-decoration-none">
          <v-btn elevation="2" fab color="d9d9d9" icon
            ><v-icon size="29px">mdi-cart</v-icon></v-btn
          >
        </nuxt-link>
        <nuxt-link to="/user-view" class="text-decoration-none">
          <v-btn elevation="2" fab icon color="d9d9d9"
            ><v-icon size="29px">mdi-account</v-icon></v-btn
          >
        </nuxt-link>
        <div class="namanya">{{ $cookies.get('cookieku').data.nama }}</div>
      </div>
    </div>
  </div>
    <div class="all-home">
      <div class="home">
        <div class="home-image">
          <v-img :src="require('~/assets/home-img.png')"></v-img>
        </div>
        <v-row>
          <div class="filter">
            <v-col cols="4">
              <v-btn @click="getallbarang()"> Semua Kategori </v-btn>
            </v-col>
          </div>
          <div class="filter" v-for="(ktg, index) in allkategori" :key="index">
            <v-col cols="4">
              <v-btn @click="getkategori(ktg)"> {{ ktg.nama }} </v-btn>
            </v-col>
          </div>
        </v-row>

        <div class="recomend f24sb">Rekomendasi untuk anda</div>
        <!-- {{ Toko }} -->
        <div>
          <div class="product-card">
            <div class="tampil1" v-if="set == 0">
              <v-row class="p-0">
                <v-col
                  class="card-col"
                  width="204px"
                  v-for="(brg, index) in allbarang"
                  :key="index"
                >
                  <div class="card">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/makanan.jpg')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col  class="">
                          <div class="title-product f14sb pl-1">
                            {{ brg.nama }}
                          </div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            {{brg.nama}}
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-1 pb-1">
                        <button
                          class="rounded-xl view-more-btn font-weight-regular"
                          style="font-size: 12px"
                          @click="todetail(brg)"
                        >
                          Lebih lengkap
                        </button>
                      </div>
                    </v-card>
                  </div>
                </v-col>
              </v-row>
            </div>
            <div class="tampil3" v-if="set == 2">
              <v-row class="p-0">
                <v-col
                  class="card-col"
                  width="204px"
                  v-for="(brg, index) in hasilcari"
                  :key="index"
                >
                  <div class="card">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/makanan.jpg')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col  class="">
                          <div class="title-product f14sb pl-1">
                            {{ brg.nama }}
                          </div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            {{ brg.deskripsi }}
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-1 pb-1">
                        <button
                          class="rounded-xl view-more-btn font-weight-regular"
                          style="font-size: 12px"
                          @click="todetail(brg)"
                        >
                          Lebih lengkap
                        </button>
                      </div>
                    </v-card>
                  </div>
                </v-col>
              </v-row>
            </div>
            <div class="tampil2" v-else>
              <v-row
                class="p-0"
                v-for="(brg, index) in hasilKategori"
                :key="index"
              >
                <v-col
                  class="card-col p-0"
                  width="204px"
                  v-for="(barang, index) in brg.barang"
                  :key="index"
                >
                  <div class="card">
                    <v-card width="204px">
                      <v-img
                        :src="require('~/assets/makanan.jpg')"
                        width="204px"
                      ></v-img>
                      <v-row>
                        <v-col cols="3" class="">
                          <div class="title-product f14sb pl-1">
                            {{ barang.nama }}
                          </div>
                        </v-col>
                        <v-col>
                          <div class="price-product f14sb pr-1">
                            Rp. 1.999.999
                          </div>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <div class="desc-product font-weight-regular pl-1">
                            {{barang.deskripsi}}
                          </div>
                        </v-col>
                      </v-row>
                      <div class="btn-card pl-1 pb-1">
                        <button
                          class="rounded-xl view-more-btn font-weight-regular"
                          style="font-size: 12px"
                          @click="todetail(brg)"
                        >
                          Lebih lengkap
                        </button>
                      </div>
                    </v-card>
                  </div>
                </v-col>
              </v-row>
            </div>
          </div>
          <div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      set: 0,
      cari: null,
      hasilcari:[],
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
      hasilKategori: {
        barang_id: "",
      },
    };
  },
  methods: {
    search(){
      // this.searchteks = this.$emit('emitsearch')
      console.log("ets"+ this.searchteks)
    },
    kontak(){
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
    gettoko() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.tokouser)
        .then((respon) => {
          this.Toko = respon.data;
        });
    },
    getallbarang() {
      axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.allbarang = respon.data;
      });
      this.set = 0;
    },
    getsearchbarang() {
      axios.get("http://127.0.0.1:8000/api/search/"+this.cari).then((respon) => {
        this.hasilcari = respon.data;
        console.log(respon.data)
      });
      this.set = 2;
    },
    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.allkategori = respon.data;
      });
    },
    getkategori(ktg) {
      axios
        .get(`http://127.0.0.1:8000/api/getkategori/${ktg.kategori_id}`)
        .then((respon) => {
          console.log(respon.data);
          this.hasilKategori = respon.data;
        });
      this.set = 1;
    },
    todetail(brg) {
      // console.log(brg.barang_id)
      this.$router.push(`/detail/${brg.barang_id}`);
    },
  },

  created() {
    const userid = this.$cookies.get("cookieku");
    this.nama = userid.data.nama;
    console.log(userid);
    this.tokouser = userid.data.id;
    this.gettoko();
    this.getallkategori();
    this.getsearchbarang();
    this.getallbarang();
  },
};
</script>
<style>
.f24sb {
  font-weight: 600;
  font-size: 24px;
  line-height: 36px;
}
.f20sb {
  font-weight: 600;
  font-size: 20px;
  line-height: 36px;
}
.f16sb {
  font-weight: 600;
  font-size: 16px;
  line-height: 24px;
}
.f14sb {
  font-weight: 600;
  font-size: 14px;
  line-height: 21px;
}
.f16m {
  font-weight: 500;
  font-size: 16px;
  line-height: 24px;
}
.f16r {
  font-weight: 400;
  font-size: 16px;
  line-height: 24px;
}
.f10r {
  font-weight: 400;
  font-size: 10px;
  line-height: 15px;
}
.ppp {
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.search {
  margin-left: 500px;
}
.round-btn {
  border-radius: 50%;
  width: 49px;
  height: 49px;
  background-color: #d9d9d9;
}
.contact-text {
  display: flex;
  font-size: 16px;
  line-height: 24px;
}
.contact-text .icon_telepon {
  margin-right: 11px;
  margin-top: 3px;
}
.nav {
  padding: 39px 123px 10px 123px;
  display: flex;
}
.logo {
  width: 43px;
  height: auto;
}
.nama_toko {
  margin-top: 4px;
  margin-left: 33px;
  font-size: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.namanya {
  display: inline-block;
  width: 100px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  margin-top: 14px;
  margin-left: 12px;
  font-size: 20px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.profile_icon_keranjang {
  display: flex;
  gap: 11px;
  margin-left: 32px;
}
.keranjang {
  margin-left: 5px;
}

.home {
  padding: 0px 123px 66px 123px;
}
.contact-text {
  font-size: 16px;
  line-height: 24px;
}
.home-container {
  padding: 0px 123px;
}
.search {
  background: #d9d9d9;
  border-radius: 100px;
}
.filter .v-btn {
  margin-top: 34px;
  border-radius: 25px;
}
.recomend {
  /* font-size: 24px;
  font-weight: 600; */
  margin-top: 13px;
}
.card-col {
  margin-top: 15px;
}
/* .title-product {
  padding-left: 3px;
} */
/* .price-product {
  padding-right: 4px;
} */
.desc-product {
  font-size: 10px;
}
.view-more-btn {
  height: 30px;
  width: 114px;
  border: 1px black solid;
}
.view-more-btn:hover {
  background: #2f432d;
  color: white;
}

.view-more-btn2 {
  margin-top: 54px;
}
/* .home_image {
}
 */

.ppp {
  overflow: hidden;
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.search-class {
  display: flex;
  border-radius: 24px;
  width: 268px;
  height: 49px;
  background-color: #d9d9d9;
  margin-left: 447px;
}
.search-class .nyari {
  width: 183px;
}
.search-class .icon_search {
  width: 38px;
  height: 38px;
}
.round-btn {
  border-radius: 50%;
  width: 49px;
  height: 49px;
  background-color: #d9d9d9;
}
.contact-text {
  display: flex;
  font-size: 16px;
  line-height: 24px;
}
.contact-text .icon_telepon {
  margin-right: 11px;
  margin-top: 3px;
}
.nav {
  padding: 39px 123px 10px 123px;
  display: flex;
}
.logo {
  width: 43px;
  height: auto;
}
.nama_toko {
  margin-top: 4px;
  margin-left: 33px;
  font-size: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.namanya {
  display: inline-block;
  width: 100px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  margin-top: 11px;
  margin-left: 12px;
  font-size: 20px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.profile_icon_keranjang {
  display: flex;
  gap: 11px;
  margin-left: 32px;
}
.keranjang {
  margin-left: 5px;
}
</style>
