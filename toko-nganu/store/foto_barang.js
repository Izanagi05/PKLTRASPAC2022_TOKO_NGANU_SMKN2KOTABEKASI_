import axios from 'axios'
export const state = () => ({
  alldatafotobarang: [],
  // editedIndex: -1
  response:null

})

export const mutations= {
  GET_DATA(state, parsdata){
    state.alldatafotobarang=parsdata
    // console.log(parsdata)
  },
  CREATE_DATA(state, adddata){
    state.alldatafotobarang.push(adddata)
    // console.log(parsdata)
  },
  UPDATE_DATA(state, updtdata){
    const index = state.alldatafotobarang.findIndex(item => item.foto_barang_id === parseInt(updtdata.foto_barang_id));
    // const index = state.alldatafotobarang.findIndex(item => item.foto_barang_id === updtdata.foto_barang_id);
    if (index !== -1) {
    // console.log(parsdata)
    const datasementara= state.alldatafotobarang

    datasementara[index]= updtdata
    state.alldatafotobarang=[...datasementara]
  }
  console.log(updtdata.foto_barang_id);
  },
  DELETE_DATA(state, id){

    const index = state.alldatafotobarang.findIndex(item => item.foto_barang_id === id);

    if (index !== -1) {
      // Hapus item dari array
      state.alldatafotobarang.splice(index, 1);
    }

  }

}
export const getters = {
  getdata: (state)=> state.alldatafotobarang,
  getresp: (state)=> state.response

}

export const actions ={
  async getdatafotobarang({commit}, paramId){
    axios
    .get("http://127.0.0.1:8000/api/getfotobarang/" +paramId)
    .then((respon) => {
      commit('GET_DATA', respon.data?.data)
      // this.barang = respon.data?.data;
    });
  },
  async tambahdata({commit}, newData){
    const formData = new FormData();
    formData.append("file", newData.file);
    axios
    .post(
      "http://127.0.0.1:8000/api/createfotobarang/" +newData.barang_id,
      formData
    )
    .then((respon) => {
      commit('CREATE_DATA', respon.data?.data)
        console.log(respon);
        // this.$store.dispatch('getdatafotobarang', newData.idbrg);
        // this.barang.push(this.detaildatadialog)
        // this.getfotobarang();
      });
  },
  async ubahdata({commit}, updatedata){
    let foto = new FormData();
    if (updatedata.file) {
      console.log("0");
      foto.append("file", updatedata.file);
    } else {
      console.log("1");
      foto.append("file", updatedata.fotolama);
    }
    axios
      .post("http://127.0.0.1:8000/api/updatefotobarang/" + updatedata.foto_barang_id, foto)
      .then((respon) => {
        console.log(respon.data);
        commit('UPDATE_DATA', respon.data?.data)

        // this.getfotobarang();
        this.$toast.success("Berhasil update");
      });
  },
  async hapusdata({commit}, iddata){
    axios
        .delete("http://127.0.0.1:8000/api/deletefotobarang/" + iddata)
        .then((respon) => {
          console.log(respon);
          // this.$toasted.success("Berhasil hapus foto barang", {
          //   position: "top-right",
          //   className: "edit-toast",
          //   duration: 3000,
          // });
      commit('DELETE_DATA', iddata)
      console.log(respon);
      // this.getfotobarang();
      // this.barang
      this.$toast.success("Berhasil hapus");
    });
  }
}


