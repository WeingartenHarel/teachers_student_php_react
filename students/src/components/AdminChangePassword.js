import React, {useEffect, useState} from 'react'
import Header from './Header'
import {Redirect} from 'react-router-dom';


const AdminChangePassword = () => {

    

    const [runRe, setRunRe] = useState(false);

    const [currentPassword, setCurrentPassword] = useState('')

    const [newPassword, setNewPassword] = useState('')

    const [newConfirmPassword, setNewConfirmPassword] = useState('')

    
    const [studentOrNot, setStudentOrNot] = useState();

    useEffect(() => {
       
        let  token = JSON.parse(localStorage.getItem("userObject"));

        if (token == null) {
            setRunRe(true);
        }else{
            setStudentOrNot(token.role);
        }

    }, []);


    const updatePassword = async (e) => {
        e.preventDefault();

        // console.log(`Current pass is : ${currentPassword}`);

        // console.log(`new pass is : ${newPassword}`);

        // console.log(`new confirm pass is : ${newConfirmPassword}`);

        let  userToken = JSON.parse(localStorage.getItem("userObject"));

        let uSerTokenForUp = userToken.token;

        const data = {
            current_password: currentPassword,
            new_password: newPassword,
            new_confirm_password: newConfirmPassword,
            token: uSerTokenForUp,
        }

        try {
            const http = await fetch(`http://127.0.0.1:8000/api/user/single/updateuserpassword`, {

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

        console.log(user.passUpdated);
        if(user.passUpdated){
            alert('Password Updated');
        }else{
            alert('Something wrong');
        }
        } catch (error) {
            alert('Password validation error');
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
                        {/* @foreach ($errors->all() as $error)
                        <p className="text-danger">{{ $error }}</p>
                     @endforeach  */}
    
                        <form method="post">
                            <div className="form-group">
                                <label for="">Current Password</label>
                                <input type="password" className="form-control"
                                 name="current_password" value={currentPassword} onChange={e => setCurrentPassword(e.target.value)}/>
                            </div>
                            <div className="form-group">
                                <label for="">New Password</label>
                                <input type="password" className="form-control" name="new_password"  value={newPassword}
                                    onChange={e => setNewPassword(e.target.value)}
                                />
                            </div>
                            <div className="form-group">
                                <label for="">Confirm new Password</label>
                                <input type="password" className="form-control" name="new_confirm_password"  value={newConfirmPassword}
                                    onChange={e => setNewConfirmPassword(e.target.value)}
                                />
                            </div>     
                            <input type="submit" className="btn btn-primary" onClick={updatePassword}/>                   
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
        studentOrNot == 0 ? <Redirect to="/student/password"/> : ''
    }
    </>
    )
}

export default AdminChangePassword
