import React, { useState, useEffect } from 'react'
import Header from './Header'
import {Redirect } from 'react-router-dom';



const Dashboard = () => {

    
    const [runRe, setRunRe] = useState(false);

    const [studentOrNot, setStudentOrNot] = useState();

    const [name, setName] = useState('');

    const [subjects, setSubjects] = useState({
        suba: '',
        subb: '',
        subc: '',
        subd: '',
    });


    

    const getUserData = async(userToken) => {
        const {token} = userToken;

        const http = await fetch(`http://127.0.0.1:8000/api/user/single/${token}?api_token=${token}`);
        const json = await http.json();

        const {name, subject_a, subject_b, subject_c, subject_d} = json[0];

        setName(`Welcome ${name}`);

        setSubjects({
            suba: subject_a,
            subb: subject_b,
            subc: subject_c,
            subd: subject_d,
        });

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

    console.log(name)

    console.log(subjects)


    return (
        <>
        <Header/>
        <div className="container">
    <div className="row justify-content-center">
        <div className="col-md-8">
            <div className="card">
                <div className="card-header">Dashboard</div>

                <div className="card-body">


                    {/* @if ($msg=Session::get('message'))
                        <div className="alert alert-success alert-dismissible" role="alert">
                           {{ $msg }}
                           <button type="button" className="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    @endif */}

                    <h4>{name}</h4>
                    <table className="table table-hover">
                        <thead>
                            <tr>                                
                            <th>Subject</th>
                            <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                <td>Subject A</td>
                                <td>{subjects.suba}</td>
                            </tr>
                            <tr>
                                <td>Subject B</td>
                                <td>{subjects.subb}</td>
                            </tr>
                            <tr>
                                <td>Subject C</td>
                                <td>{subjects.subc}</td>
                            </tr>
                            <tr>
                                <td>Subject D</td>
                                <td>{subjects.subd}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 {
        runRe ? <Redirect to="/"/> : ''
    }

    {
        studentOrNot == 1 ? <Redirect to="/admin/dashboard"/> : ''
    }
        </>
    )
}

export default Dashboard
