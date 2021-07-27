import React, { useState, useEffect } from 'react'
import Header from './Header'
import {Redirect } from 'react-router-dom';



const AdminDashboard = () => {

    
    const [runRe, setRunRe] = useState(false);

    const [studentOrNot, setStudentOrNot] = useState();

    useEffect(() => {
       
        let  token = JSON.parse(localStorage.getItem("userObject"));

        if (token == null) {
            setRunRe(true);
        }else{
            setStudentOrNot(token.role);
        }

    }, []);


    return (
        <>
        <Header/>
        <div className="container">
    <div className="row justify-content-center">
        <div className="col-md-8">
            <div className="card">
                <div className="card-header">'Dashboard</div>

                <div className="card-body text-left">

                Iam an admin
                  
                </div>
            </div>
        </div>
    </div>
</div>
 {
        runRe ? <Redirect to="/"/> : ''
    }

    {
        studentOrNot == 0 ? <Redirect to="/student/dashboard"/> : ''
    }
        </>
    )
}

export default AdminDashboard