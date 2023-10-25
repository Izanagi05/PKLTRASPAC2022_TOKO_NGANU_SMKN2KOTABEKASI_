<template>
  <div>
    <v-row class="pa-4">
      <v-col cols="4">
        <v-card
          class="px-4 py-6 rounded-xl"
          style="border-bottom: 8px solid #408e91"
        >
          <div class="font-weight-medium text-h6">Items</div>
          <div class="font-weight-bold text-h5 mt-4">
            {{ alljumlah.JBarang }}
          </div>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card
          class="px-4 py-6 rounded-xl"
          style="border-bottom: 8px solid #e49393"
        >
          <div class="font-weight-medium text-h6">Kategori</div>
          <div class="font-weight-bold text-h5 mt-4">
            {{ alljumlah.JKategori }}
          </div>
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card
          class="px-4 py-6 rounded-xl"
          style="border-bottom: 8px solid #00a3ff"
        >
          <div class="font-weight-medium text-h6">Rating</div>
          <div class="font-weight-bold text-h5 mt-4">
            {{ alljumlah.JRating }}
          </div>
        </v-card>
      </v-col>
    </v-row>
    <div
      class="pa-4"
      style="
        background: #e9e9e9;
        overflow-x: hidden;
        height: 70vh;
        overflow-y: scroll;
      "
    >
      <v-row>
        <v-col cols="8">
          <v-card class="pa-4 rounded-xl">
            <div class="text-h6 font-weight-medium">ini chart</div>
          </v-card>
        </v-col>
        <v-col cols="4">
          <v-card class="pa-4 rounded-xl">
            <div class="text-h6 font-weight-medium">Payment</div>
          </v-card>
        </v-col>
        <v-col cols="4">
          <v-card class="pa-4 rounded-xl">
            <div class="text-h6 font-weight-medium">Kategori</div>
            <div style="height: 20vh; overflow-x: hidden; overflow-y: scroll">
              <div v-for="(dt, i) in allkategori" :key="i">
                <div class="d-flex">
                  <div class="font-weight-light">
                    {{ dt.tgl_formatku }}
                  </div>
                  <div class="ml-2">{{ dt.nama }}</div>
                </div>
              </div>
            </div>
          </v-card>
        </v-col>
        <v-col cols="8">
          <v-card class="pa-4 rounded-xl">
            <div class="text-h6 font-weight-medium">
              Produk <span class="text-body-1 font-weight-regular"> from </span>
              <v-menu v-model="menutoko" :close-on-content-click="false" :close-on-click="false">


                <template v-slot:activator="{ on, attrs }">
                <v-chip color="#E8F5E9" class="green--text" v-on="on" v-bind="attrs" @click="menutoko=!menutoko"> {{idnamatokopilihan.nama}} </v-chip>
              </template>
              <v-card class="pa-4 white">
                <div class="d-flex justify-end mb-1">
                  <v-icon small @click="menutoko=!menutoko">mdi-close</v-icon>
                </div>
                  Pilih Toko
                <v-text-field hide-details v-model="searchtoko" @keydown.enter="getalltoko"></v-text-field>
                <div style="height: 10vh; overflow-y: scroll">
                  <div class="" v-for="(tk,i) in alltoko" :key="i">
                    <v-chip color="#E8F5E9" class="green--text my-1" @click="tokoterpilih(tk)"> {{tk.nama}} </v-chip>
                  </div>
                </div>
              </v-card>
              </v-menu>
            </div>
            <div style="height: 80vh; overflow-y: scroll" class="rounded-lg">
              <v-data-table :headers="headerstoko" :items="Toko">
                <template v-slot:[`item.foto_barang_first`]="{ item }">
                  <div>
                    <div class="d-flex justify-center align-center">
                      <div
                        class="image-container3 rounded-lg d-flex justify-center align-center"
                      >
                        <img
                          :src="
                            'http://127.0.0.1:8000/storage/' +
                            item.foto_barang_first
                          "
                          class="rounded-lg"
                          width="60%"
                          height="60%"
                        />
                      </div>
                    </div>
                  </div>
                </template>
              </v-data-table>
            </div>
          </v-card>
        </v-col>
        <v-col cols="12">
          <v-card class="pa-4 rounded-xl">
            <div class="text-h6 font-weight-medium">Transaksi Terbaru</div>
            <div style="height: 80vh; overflow-y: scroll" class="rounded-lg">
              <v-data-table :headers="headers" :items="alldatatransakasi">
                <template v-slot:[`item.foto_barang_first`]="{ item }">
                  <div>
                    <div class="d-flex justify-center align-center">
                      <div
                        class="image-container4 rounded-lg d-flex justify-center align-center"
                      >
                        <img
                          :src="
                            'http://127.0.0.1:8000/storage/' +
                            item.foto_barang_first
                          "
                          class="rounded-lg"
                          width="80%"
                          height="80%"
                        />
                      </div>
                      <div class="">
                        {{ item.xjumlah }}
                      </div>
                    </div>
                  </div>
                </template>
                <template v-slot:[`item.aksistatus`]="{ item }">
                  <div>
                    <v-chip
                      :class="statuscolor(item).textClass"
                      :color="statuscolor(item).bgColor"
                    >
                      {{ item.status }}
                    </v-chip>
                  </div>
                </template>
                <template v-slot:[`item.total_harga`]="{ item }">
                  <div>Rp. {{ item.total_harga }}</div>
                </template>
              </v-data-table>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: ["middlewareku", "middlewarerole"],
  layout: "AdminView",
  data() {
    return {
      menutoko:false,
      searchtoko:'',
      idnamatokopilihan:{
        toko_id:null,
        nama:'null',
      },
      alltoko:[],
      headers: [
        { text: "Tanggal ", value: "ftgl_transaksi" },
        { text: "User ", value: "nama_pengguna" },
        { text: "Produk", value: "foto_barang_first" },
        { text: "Barang", value: "nama_barang" },
        { text: "Total harga ", value: "total_harga" },
        { text: "Ongkir ", value: "ongkos_kirim" },
        { text: "Status ", value: "aksistatus" },
      ],
      headerstoko: [
        { text: "Foto Barang ", value: "foto_barang_first" },
        { text: "Nama Barang", value: "nama" },
        { text: "Kategori", value: "nama_kategori" },
        { text: "Total Variant", value: "total_varian" },
        { text: "Deskripsi ", value: "total_harga" },
        { text: " Aksi ", value: "ongkos_kirim" },
      ],
      alljumlah: [],
      allkategori: [],
      alldatatransakasi: [],
    };
  },
  computed: {
    Toko() {
      return this.$store.state.barang.alldatabarang;
    },
  },
  methods: {

    getalltoko() {
      axios.get("http://127.0.0.1:8000/api/searchtoko/" +this.searchtoko).then((respon) => {
        console.log(respon);
        this.alltoko = respon.data?.data;
      });
    },
    tokoterpilih(tk){
      this.idnamatokopilihan.toko_id=tk.toko_id
      this.idnamatokopilihan.nama=tk.nama
      this.getalltoko()
      this.getbarang()
    },
    getalljumlah() {
      axios
        .get("http://127.0.0.1:8000/api/getjumlahallbarangkategorirating")
        .then((respon) => {
          console.log(respon);
          this.alljumlah = respon.data?.data;
        });
    },
    getbarang() {

      this.$store.dispatch("barang/getdatabarang",  this.idnamatokopilihan.toko_id);
      this.$store.dispatch("kategori/getdatakategori");
    },

    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.allkategori = respon.data?.data;
      });
    },
    gettransaksiterbaru() {
      axios
        .get("http://localhost:8000/api/gettransaksiterbaru")
        .then((respon) => {
          this.alldatatransakasi = respon.data?.data;
        });
    },
    statuscolor(item) {
      if (item.admin_konfirmasi === "Ya") {
        return {
          bgColor: "#E8F5E9",
          textClass: "green--text",
        };
      } else if (item.admin_konfirmasi === "Tidak") {
        return {
          bgColor: "#FFEBEE",
          textClass: "red--text",
        };
      } else {
        return {
          bgColor: "#FFF3E0",
          textClass: "orange--text",
        };
      }
    },
  },
  created() {
    this.getallkategori();
    this.gettransaksiterbaru();
    this.getalltoko();
    this.getalljumlah();
    this.getbarang();
  },
};
</script>
<style>
.image-container3 {
  width: 100px;
  height: 100px;
  overflow: hidden;
}

.image-container3 img {
  object-fit: cover;
  object-position: center;
}
.image-container4 {
  width: 80px;
  height: 80px;
  overflow: hidden;
}

.image-container4 img {
  object-fit: cover;
  object-position: center;
}
</style>
