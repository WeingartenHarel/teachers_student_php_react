import React, {useState, useEffect} from 'react'
import Header from './Header'

import {Redirect } from 'react-router-dom';


const Register = () => {

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');

    const [status, setStatus] = useState(null);


    // let  token = localStorage.getItem("token");

    // useEffect(() => {
        
    //     if (token) {
    //         setStatus('loggedin');
    //     }

      
    // }, []);


    let  token = JSON.parse(localStorage.getItem("userObject"));

    useEffect(() => {
        
        if (token) {
            setStatus(token.role);
        }

      
    }, []);

    const signUp = async (e) => {
        e.preventDefault();

        // console.log(`name is ${name}`);
        // console.log(`email is ${email}`);
        // console.log(`password is ${password}`);
        // console.log(`confirmPassword is ${confirmPassword}`);


        
        const data = {
            name: name,
            email: email,
            password: password,
            password_confirmation: confirmPassword,
        }

        const http = await fetch(`http://127.0.0.1:8000/api/users/register`, {

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
        //     localStorage.setItem('token', user.token);
        //     setStatus('loggedin');

        // }else{
        //   setStatus(user.msg);

        // }

        console.log(user);

       

        
        if (user.status) {
            localStorage.setItem('userObject', JSON.stringify({name: user.name, role: user.role, token: user.token}));
            setStatus(user.role);

        }else{
          setStatus(user.msg);

        }

    }




    return (
        <>
        <Header/>
        <div className="container">
    <div className="row justify-content-center">
        <div className="col-md-8">
            <div className="card">
                <div className="card-header">Register
                {
                    status !=null && status != true  ?  <span className="invalid-feedback d-block" role="alert">
                                            <strong>{status}</strong>
                                        </span> : ''
                    }
                </div>

                <div className="card-body">
                    <form method="POST">
                        {/* @csrf */}

                        <div className="form-group row">
                            <label for="name" className="col-md-4 col-form-label text-md-right">'Name</label>

                            <div className="col-md-6">
                                <input id="name" type="text"
                                 className="form-control 
                                 " name="name" value={name} required autocomplete="name" autofocus onChange={e => setName(e.target.value)}/>

                                {/* @error('name')
                                    <span className="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror */}
                            </div>
                        </div>

                        <div className="form-group row">
                            <label for="email" className="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div className="col-md-6">
                                <input id="email" type="email" className="form-control" name="email" value={email}
                                 onChange={e => setEmail(e.target.value)}
                                 required autocomplete="email"/>

                                {/* @error('email')
                                    <span className="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror */}
                            </div>
                        </div>

                        <div className="form-group row">
                            <label for="password" className="col-md-4 col-form-label text-md-right">password_confirmation</label>

                            <div className="col-md-6">
                                <input id="password" type="password" className="form-control" value={password}
                                 name="password" required autocomplete="new-password"  onChange={e => setPassword(e.target.value)}/>
                                

                                {/* @error('password')
                                    <span className="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror */}
                            </div>
                        </div>

                        <div className="form-group row">
                            <label for="password-confirm" className="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div className="col-md-6">
                                <input id="password-confirm" type="password" className="form-control"
                                 name="password_confirmation" required autocomplete="new-password"
                                 value={confirmPassword}
                                   onChange={e => setConfirmPassword(e.target.value)}/>
                            </div>
                        </div>

                        <div className="form-group row mb-0">
                            <div className="col-md-6 offset-md-4">
                                <button onClick={signUp} className="btn btn-primary">
                                    Register
                                </button>
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

    {/* {
        status == 1 ? <Redirect to="/admin/profile"/> : ''
    } */}
</>
    )
}

export default Register
