<template>
  <div>
    <div class="pl-15s pb-5 font-weight-medium text-h6">Detail Barang</div>
    <!-- <v-dialog v-model="dialogDelete"  max-width="800px" class="rounded-lg">
        <v-card class="pt-15 px-8 pb-8 rounded-lg">
          <div class="text-h6 pl-4">Apakah kamu yakin ingin menghapus item ini?</div>
          <div class="grey--text text-body-2 pl-4 mt-4">
            Item yang sudah dihapus tidak bisa dikembalikan lagi
          </div>
          <div class="d-flex justify-end mt-15">
            <v-btn class="rounded-lg" outlined @click="closeDelete"
              >Batal</v-btn
            >
            <v-btn
            class="rounded-lg ml-8 white--text"
              color="#FF3548"
            @click="confirmhapusbarang"
            >Hapus</v-btn
          >
          </div>
      </v-card>
    </v-dialog> -->

    <DialogDelete  :dialogDelete="dialogDelete" :confirmhapus="confirmhapusbarang" :closeDelete="closeDelete"/>
    <DialogUpdate :dialogedit="dialogedit" item="Barang" :kategori="Kategori" :detaildatadialog="detaildatadialog" :closeedit="closeedit" :updateedit="updatebarang"/>
    <div  style="height: 80vh; overflow-y: scroll;" class="rounded-lg">
    <v-data-table class="" :headers="headers" :items="Toko">
      <template v-slot:[`item.aksivarian`]="{ item }">
        <v-btn
          class="rounded-lg mx-2"
          small
          @click="detailbarang(item)"

          style="margin: 15px 15px 15px 0px"
        >
          buat varian
        </v-btn>
        </template>
        <template v-slot:[`item.aksifotobarang`]="{ item }">
        <v-btn
        class="rounded-lg mx-2"
          small
          @click="detailfotobarang(item)"

          style="margin: 15px 15px 15px 0px"
        >
          info foto barang
        </v-btn>
        </template>
        <template v-slot:[`item.aksi`]="{ item }">
        <v-btn
          class="mx-2 "
          icon
          color="#4caf50"
          small
          @click="ubahbarang(item)"
          style="margin: 15px 15px 15px 0px"
        >
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn
          class="mx-2 "
          icon
          color="#ff5252"
          small
          @click="hapusbarang(item)"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
    </v-data-table>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  layout: 'UserView',
  middleware: "middlewareku",
  data() {
    return {
      prm: this.$route.params,
      dialogedit: false,
      dialogDelete: false,
      barangtoko: null,
      headers: [
        { text: "Nama Barang", value: "nama" },
        { text: "Deskripsi", value: "deskripsi" },
        { text: "Detail Varian", value: "aksivarian" },
        { text: "Detail Foto", value: "aksifotobarang" },
        { text: "Aksi", value: "aksi" },
      ],
      detaildatadialog: {
        barang_id: "",
        kategori_id: "",
        nama: "",
        deskripsi: "",
      },
      defaultItem: {
        barang_id: "",
        kategori_id: "",
        nama: "",
        deskripsi: "",
      },

      // Toko:null,
    };
  },
  computed:{
    Toko(){
      return this.$store.state.barang.alldatabarang
    },
    Kategori(){
      return this.$store.state.kategori.alldatakategori
    }
  },
  methods: {
    getbarang() {
      this.$store.dispatch('barang/getdatabarang', this.prm.toko_id )
      this.$store.dispatch('kategori/getdatakategori')
    },
    detailbarang(item) {
      this.$router.push(
        `/user-view/toko-user/detailtoko/detailbarang/varianbarang/${item.barang_id}`
      );
    },
    detailfotobarang(item) {
      this.$router.push(
        `/user-view/toko-user/detailtoko/detailbarang/fotobarang/${item.barang_id}`
      );
    },
    ubahbarang(item) {
      this.indexnya = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogedit = true;
      console.log(item)
    },

    updatebarang() {
      this.$store.dispatch('barang/ubahdata',  this.detaildatadialog )
      console.log(this.detaildatadialog)
      this.closeedit()
      this.$toast.success("Berhasil update");
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialog = Object.assign({}, this.defaultItem);
      });
      this.dialogedit = false;
    },
    hapusbarang(item) {
      this.editedIndex = this.Toko.indexOf(item);
      this.detaildatadialog = Object.assign({}, item);
      this.dialogDelete = true;
    },
    confirmhapusbarang() {
      this.$store.dispatch('barang/hapusdata', this.detaildatadialog.barang_id)
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },

  created() {
    const tokoid = this.$cookies.get("cookieku");
    this.barangtoko = tokoid.data.id;
    this.getbarang();
  },
};
</script>
