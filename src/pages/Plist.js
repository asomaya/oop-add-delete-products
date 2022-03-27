import React from 'react';
import axios from 'axios';
import './style.css'
import { Link } from 'react-router-dom';
class Plist extends React.Component {
  state = {
    checkedBoxes : [],
    contacts: []
  }

  toggleCheckbox = (e, contact) => {      
    if(e.target.checked) {
        let arr = this.state.checkedBoxes;
        arr.push(contact.id);
         
        this.setState = { checkedBoxes: arr};
    } else {            
        let items = this.state.checkedBoxes.splice(this.state.checkedBoxes.indexOf(contact.id), 1);
         
        this.setState = {
            checkedBoxes: items
        }
    }       
    console.log(this.state.checkedBoxes);
   
}


   deleteByIds (e ) { //alert(id)
    e.preventDefault();

    let formData = new FormData();
    this.state.checkedBoxes.forEach((item)=>{
     formData.append('id[]',item)
    })

    axios({
        method: 'post',
        url: 'http://localhost/ya/task/Back_end/list.php',
        data: formData,
        config: { headers: {'Content-Type': 'multipart/form-data' }}
    
})
.then(function (response) {
    //handle success
    console.log(response)
   // alert('New Contact Successfully Added.');  
})
.catch(function (response) {
    //handle error
    console.log(response)
});
}

  componentDidMount() {
    const url = 'http://localhost/ya/task/Back_end/list.php'
    axios.get(url).then(response => response.data)
    .then((data) => {
      this.setState({ contacts: data })
      console.log(this.state.contacts)
     })
  }


  

 render() {
    return (
        <div>
          <div className='container  head'>
            <h1>Product List </h1>
            <div>
        <button name='delete' className="btn btn-danger btn-sm m-2" onClick={(e) => {this.deleteByIds(e) }}>  MASS DELETE</button>
        <Link to='/add'> <button className="btn btn-primary btn-sm m-2"> Add Product </button></Link>
       </div></div>
       <div className="container">
       <hr></hr>
        <div className="row align-items-start">
       {this.state.contacts.map((contact, index) => (
          
           <div className="col-4">
       <div className="card" key={index} >
            
           <div className="card-body">
           <input type="checkbox" name='id []' className="selectsingle delete-checkbox" value="{contact.id}" checked={this.state.checkedBoxes.find((p) => p.id === contact.id)} onChange={(e) => this.toggleCheckbox(e, contact)} />
   <div className='center'>
    <h5 className="card-title">{ contact.sku}</h5>
    <h5 className="card-title">{ contact.Name}</h5>
    <h5 className="card-title">{ contact.price}$</h5>
    <h5 style={contact.DS===null ? {display:'none'} :{display:'block'}} className="card-title">Size:{ contact.DS} MB</h5>
    <h5 style={contact.BW===null ? {display:'none'} :{display:'block'}} className="card-title">weight:{ contact.BW}KG</h5>
    <h5 style={contact.fh===null ? {display:'none'} :{display:'block'}} className="card-title">Dimension:{ contact.fh}x{ contact.fw}x{ contact.fl}</h5>
    </div></div>
    </div> 
    <br></br> 
    </div>
       ))}
    
   </div> 
 
 </div>
 
  </div>
  );
  }
}
export default Plist;