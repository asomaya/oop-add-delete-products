import React from 'react';
import axios from 'axios';
import { Link ,Navigate} from 'react-router-dom';

const initialState = {
  sku: '',
    name: '',
    price: '',
    size:'',
    height:'',
    width:'',
    length:'',
    weight:'',
    showhide: '',
    skuErr: '',
    nameErr: '',
    priceErr: '',
    sizeErr:'',
    heightErr:'',
    widthErr:'',
    lengthErr:'',
    weightErr:'',
    subErr: '',
    selectErr: '',
};
class Padd extends React.Component {
  
  state = initialState;
 
  validate = () => {
    let skuErr="";
   let nameErr="";
  let  priceErr="";
  let  sizeErr="";
  let  heightErr="";
 let   widthErr="";
  let  lengthErr="";
 let   weightErr="";
 let selectErr ="";
 if (!this.state.sku) {
  skuErr = "name cannot be blank";
}
   
    if (!this.state.name) {
      nameErr = "name cannot be blank";
    }
   
    if (!this.state.price) {
      priceErr = "invalid value";
    }

 
    if (!this.state.showhide){
    
      selectErr = "please select the product type";
    }
     if(this.state.showhide==='1'){
      if (!this.state.size) {
       sizeErr = "size required";}}
       if(this.state.showhide==='3'){
        if (!this.state.weight) {
         weightErr = "weight required";}}
         if(this.state.showhide==='2'){
          if (!this.state.height) {
           heightErr = "height required";}
           if (!this.state.width) {
            widthErr = "width required";}
            if (!this.state.length) {
              lengthErr = "length required";}}
  
    if (skuErr || nameErr || priceErr || sizeErr || weightErr || heightErr ||widthErr ||lengthErr ||  selectErr) {
      this.setState({ skuErr, nameErr ,priceErr , sizeErr,weightErr ,heightErr ,widthErr ,lengthErr, selectErr});
      return false;
    }

    return true;
  };

      handleshowhide (e) {
        const getType = e.target.value;    
          this.setState({showhide: getType});
        }

redirect(){
  this.state={condition:false};
}
 
    handleFormSubmit( event ) {
      event.preventDefault();
     
      
      const isValid = this.validate();
      if (isValid) {
      let formData = new FormData();
      formData.append('sku', this.state.sku)
      formData.append('name', this.state.name)
      formData.append('price', this.state.price)
      formData.append('size', this.state.size)
      formData.append('weight', this.state.weight)
      formData.append('height', this.state.height)
      formData.append('width', this.state.width)
      formData.append('length', this.state.length)
      axios({
          method: 'post',
          url: 'http://localhost/ya/task/Back_end/add.php',
          data: formData,
          config: { headers: {'Content-Type': 'multipart/form-data' }}
      })
      .then(function (response) {
          //handle success
         
          console.log(response)
                })
      .catch(function (response) {
          //handle error
          console.log(response)
      });
      this.setState({condition:true});
      
      this.setState(initialState);
      
       }else {let subErr="";
         subErr = "please, submit required data";
      if (subErr ) {
        this.setState({ subErr});}
    }
  }
 
 


  render() {
  const {condition}=this.state;
  if (condition) {
    return<Navigate to='/'replace/>
  }

    return (
     
<div>
<div className='container head'>
        <h1 className="page-header text-center">Product Add</h1>
        <div>
         <button type="submit" className="btn btn-primary  m-2" onClick={e => this.handleFormSubmit(e)}   value="save" >Save</button>
      <Link to='/'>  <button className="btn btn-outline-primary m-2">cancel</button></Link>
        <div style={{ fontSize: 20, color: "red" }}> {this.state.subErr} </div>
        </div></div>
          <div className="container">
          <hr></hr>
          <div className="col-md-4">
            <div className="panel panel-primary">
               
                <div className="panel-body">
                <form id='product_form'>
                <label>sku</label> 
                <input type="text" name="sku" id="sku" placeholder="sku" className="form-control" value={this.state.sku} onChange={e => this.setState({sku: e.target.value })}/>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.skuErr} </div>
                 <label>name</label>
                <input type="text" name="name" id="name" placeholder="name" className="form-control" value={this.state.name} onChange={e => this.setState({ name: e.target.value })}/>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.nameErr} </div>
                <label>price($)</label>
                <input type="number" name="price"  id="price" placeholder="price" className="form-control" value={this.state.price} onChange={e => this.setState({ price: e.target.value })}/>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.priceErr} </div>
               
                
            </form>

                </div>
            </div>
        </div>
        
        
        <div className="row">
  <div className="col-lg-4 ">
  <span>Type switcher</span>
   <select className="form-select" aria-label="Default select example" id='productType' onChange={(e)=>(this.handleshowhide(e))}>
  <option value="">type switcher</option>  
  <option value="1">DVD</option>
  <option value="2">Furniture</option>
  <option value="3">Book</option>
</select>
</div>
</div>
{
             this.state.showhide==='1' && (
              <div className="row" id="DVD">
              <div className="col-lg-4">
                <input type="number" id='size' name="size" className="form-control" placeholder="size" aria-label="si"  value={this.state.size} onChange={e => this.setState({ size: e.target.value })} />
                <label className="mb-2">please provide size in (MB)</label>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.sizeErr} </div>
              </div>
                </div>
             )}           

             {
             this.state.showhide==='2' && (
              <div className="row"  id="Furniture">
              <div className="col-lg-4">
                <input type="number"  className="form-control" placeholder="height" aria-label="si" name='height'  id="height" value={this.state.height} onChange={e => this.setState({height : e.target.value })}/>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.heightErr} </div>
                <input type="number"  className="form-control" placeholder="width" aria-label="si" name='width' id="width" value={this.state.width} onChange={e => this.setState({width : e.target.value })}/>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.widthErr} </div>
                <input type="number" className="form-control" placeholder="length" aria-label="si" name='length'  id="length" value={this.state.length} onChange={e => this.setState({length : e.target.value })} />
                <div style={{ fontSize: 12, color: "red" }}> {this.state.lengthErr} </div>
                <label className="mb-2">please provide dimension in (HxWxL)</label>
              </div>
                </div>
             ) }

             {
           this.state.showhide==='3' && (
              <div className="row" id="Book">
              <div className="col-lg-4">
                <input type="number" className="form-control" name='weight' placeholder="weight" aria-label="si"  id="weight"  value={this.state.weight} onChange={e => this.setState({ weight: e.target.value })} />
                <label className="mb-2">please provide weight in (KG)</label>
                <div style={{ fontSize: 12, color: "red" }}> {this.state.weightErr} </div>
              </div>
                </div>
             ) }
        
        <div style={{ fontSize: 12, color: "red" }}> {this.state.selectErr} </div>
        
         </div>
         </div>
        );
  }
}
export default Padd;