// import logo from './logo.svg';
import './App.css';


import Header from './components/Header';

import Login from './components/Login'

import Register from './components/Register'
import Profile from './components/Profile';

import ChangePassword from './components/ChangePassword'
import Logout from './components/Logout'

import Dashboard from './components/Dashboard';

import AdminDashboard from './components/AdminDashboard'

import AdminProfile from './components/AdminProfile'

import AdminChangePassword from './components/AdminChangePassword'


import Period from './components/Period';


import {Switch, Route} from 'react-router-dom'

function App() {
  return (
    <div className="App">


<Switch>
  <Route exact path="/"><Login/></Route>
  <Route exact path="/register"><Register/></Route>
  <Route exact path="/student/profile"><Profile/></Route>


 
  <Route exact path="/student/password"><ChangePassword/></Route>

  <Route exact path="/student/dashboard"><Dashboard/></Route>



  <Route exact path="/admin/profile"><AdminProfile/></Route>


 
<Route exact path="/admin/password"><AdminChangePassword/></Route>

<Route exact path="/admin/dashboard"><AdminDashboard/></Route>


//periods related


<Route exact path="/admin/periods"><Period/></Route>





  <Route exact path="/logout"><Logout/></Route>


  {/* <Route exact path="/student/profile"><Profile/></Route>
  <Route exact path="/student/profile"><Profile/></Route> */}
  
</Switch>

   
    
    </div>
  );
}

export default App;
