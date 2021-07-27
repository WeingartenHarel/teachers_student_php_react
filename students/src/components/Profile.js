import React, {useEffect, useState} from 'react'
import Header from './Header'
import {Redirect} from 'react-router-dom';

const Profile = () => {

    const [runRe, setRunRe] = useState(false);

    const [name, setName] = useState('');

    const [email, setEmail] = useState('');

    const [studentOrNot, setStudentOrNot] = useState();

    const getUserData = async(userToken) => {

        const {token} = userToken;

        const http = await fetch(`http://127.0.0.1:8000/api/user/single/${token}?api_token=${token}`);
        const json = await http.json();

        const {name, email} = json[0];

        setName(name);

        setEmail(email);

        // console.log(json[0]);
    }


    useEffect(() => {
       
        let  token = JSON.parse(localStorage.getItem("userObject"));

        if (token == null) {
            setRunRe(true);
        }else{
            setStudentOrNot(token.role);
            getUserData(token);

            
        }

    }, []);


    const updateUser = async (e) => {
        e.preventDefault();

        let  userToken = JSON.parse(localStorage.getItem("userObject"));

        let uSerTokenForUp = userToken.token;

        const data = {
            name: name,
            email: email,
            token: uSerTokenForUp,
        }

        const http = await fetch(`http://127.0.0.1:8000/api/user/single/update`, {

            method: 'PUT', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
              'Content-Type': 'application/json',
              'Authorization' : 'Bearer '+uSerTokenForUp,
              // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header

          });

          const user = await http.json();

          //console.log(user);
        // console.log(`Name is: ${name}`);
        // console.log(`Email is: ${email}`);

        if(user.update){

            userToken.name = name;

            localStorage.setItem('userObject', JSON.stringify(userToken));

            alert('User Updated');
        }else{
            alert('Something wrong');
        }
    }
    return (
        <>
            <Header/>
        <div className="container">
        <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Dashboard</div>
                    <div className="card-body">
                    <form>
                            <div className="form-group">
                                <label for="">Name</label>
                                <input type="text" className="form-control"
                                 name="name" value={name}  onChange={e => setName(e.target.value)}/>
                            </div>
                            <div className="form-group">
                                <label for="">Email</label>
                                <input type="text" className="form-control"
                                 name="email" value={email} onChange={e => setEmail(e.target.value)}/>
                            </div>     
                            <input type="submit" className="btn btn-primary" value="Update" onClick={updateUser}/>                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {
        runRe ? <Redirect to="/"/> : ''

        
    }

    {
        studentOrNot == 1 ? <Redirect to="/admin/profile"/> : ''
    }
    </>
    )
}

export default Profile
