import React, { useState, useEffect } from 'react'
import Header from './Header'
import {Redirect } from 'react-router-dom';


const Login = () => {

    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')

    const [rememberMe, setRememberMe] = useState('off');

    const [status, setStatus] = useState(null);


    let  token = JSON.parse(localStorage.getItem("userObject"));

    useEffect(() => {
        
        if (token) {
            setStatus(token.role);
        }

      
    }, []);


    const userLogin = async (e) => {
        e.preventDefault();

        // console.log(`email is: ${email}`)

        // console.log(`password is: ${password}`)

        // console.log(`rememver is ${rememberMe}`);

        const data = {
            email: email,
            password: password,
            remember: rememberMe,
        }

        const http = await fetch(`http://127.0.0.1:8000/api/users/login`, {

            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
              'Content-Type': 'application/json'
              // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header

          });

          const user = await http.json();

        //   if (user.status) {
        //       localStorage.setItem('token', user.token);
        //       setStatus('loggedin');

        //   }else{
        //     setStatus(user.dontExist);

        //   }



        
        if (user.status) {
            localStorage.setItem('userObject', JSON.stringify({name: user.name, role: user.role, token: user.token}));
            setStatus(user.role);

        }else{
          setStatus(user.dontExist);

        }
      
        

    }

    const checkOrNot = (e) => {
        if (e.target.checked) {
            setRememberMe('on');
            return;
        }

        setRememberMe('off');
    }

    return (
        <>
        <Header/>
        <div className="container">
        <div className="row justify-content-center">

            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Login
                    
                    {
                        status !=null && status != true ?  <span className="invalid-feedback d-block" role="alert">
                                            <strong>{status}</strong>
                                        </span> : ''
                    }
                   
                    </div>
    
                    <div className="card-body">
                        <form method="POST">
                            


                            
                        <div className="form-group row">
                                <label for="email" className="col-md-4 col-form-label text-md-right">E-Mail Address</label>
    
                                <div className="col-md-6">
                                    <input id="email" type="email" className="form-control" value={email}
                                      required autocomplete="email" autofocus onChange={e => setEmail(e.target.value)}/>
    
                                  
                                 
                                </div>
                            </div>
    
                            <div className="form-group row">
                                <label for="password" className="col-md-4 col-form-label text-md-right">Password</label>
    
                                <div className="col-md-6">
                                    <input id="password" type="password" className="form-control" name="password"
                                    value={password}
                                    onChange={e => setPassword(e.target.value)}
                                     required autocomplete="current-password"/>
    
                                   
                                 
                                </div>
                            </div>
    
                            <div className="form-group row">
                                <div className="col-md-6 offset-md-4">
                                    <div className="form-check">
                                        <input className="form-check-input" onClick={checkOrNot} type="checkbox" name="remember" id="remember"/>
    
                                        <label className="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div className="form-group row mb-0">
                                <div className="col-md-8 offset-md-4">
                                    <button onClick={userLogin} className="btn btn-primary">
                                        Login
                                    </button>
    
                                  
                                        <a className="btn btn-link" href="#">
                                           Forgot Your Password
                                        </a>
                                  
                                </div>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {
        status == 0 ? <Redirect to="/student/profile"/> : ''
    }

    
    {
        status == 1 ? <Redirect to="/admin/profile"/> : ''
    }
    </>
    )
}

export default Login
