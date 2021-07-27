import React, {useState, useEffect} from 'react'
import {Link} from 'react-router-dom';


const Header = () => {

    //let  token = localStorage.getItem("token");

    const [token, setToken] = useState();

    const [name, setName] = useState('Loading...');


    useEffect(() => {
        let data = JSON.parse(localStorage.getItem("userObject"));

            setToken(data);

            if (data) {
                setName(data.name)
            }
        
    }, []);



  

    return (
        <div id="app" className="mb-4">
        <nav className="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div className="container">
                <a className="navbar-brand" href="/">
                   App
                </a>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    {/* <!-- Left Side Of Navbar --> */}
                    <ul className="navbar-nav mr-auto">

                    </ul>

                    {/* <!-- Right Side Of Navbar --> */}
                    <ul className="navbar-nav ml-auto">
                        {/* <!-- Authentication Links --> */}
                      
{
    token == null?  <li className="nav-item"> <Link className="nav-link" to="/">Login</Link></li> : ''
    
}

{
    token == null ?  <li className="nav-item"> <Link className="nav-link" to="/register">Register</Link></li>  : ''
}

{
    token ? token.role == 0 ? <li className="nav-item"> <Link className="nav-link" to="/student/dashboard">Dashboard</Link> </li>: '' : ''
   }

   {
    token ? token.role == 1 ? <li className="nav-item"> <Link className="nav-link" to="/admin/dashboard">Dashboard</Link> </li>: '' : ''
   }
                                


                        
                        {
                            token ? <li className="nav-item dropdown">
                                <a id="navbarDropdown" className="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {name}
                                </a>
                                

                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                 

                                 {
                                    token.role == 0 ? <Link className="dropdown-item" to="/student/profile">Profile</Link> : ''
                                 }
                                
                                 {
                                    token.role == 0 ?   <Link className="dropdown-item" to="/student/password">Change password</Link> : ''
                                 }
                                    
                                 

                                 
                                 {
                                    token.role == 1 ? <Link className="dropdown-item" to="/admin/profile">Profile</Link> : ''
                                 }
                                
                                 {
                                    token.role == 1 ?   <Link className="dropdown-item" to="/admin/password">Change password</Link>
                                   : ''
                                 }

                                 {
                                    token.role == 1 ?   <Link className="dropdown-item" to="/admin/periods">Period</Link>
                                   : ''
                                 }

                                  
                                
                                    
                                   
                                    <Link className="dropdown-item" to="/logout">
                                     Logout
                                    </Link>
                                    
                                    <form id="logout-form"  className="d-none">
                                       
                                    </form>
                                </div>
                            </li> : ''
                        }

                               
                            
                            
                       
                    </ul>
                </div>
            </div>
        </nav>
        </div>
    )
}

export default Header
