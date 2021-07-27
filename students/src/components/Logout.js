import React, {useState,useEffect} from 'react'

import {Redirect} from 'react-router-dom';

const Logout = () => {

    const token = localStorage.getItem("userObject");
  

    useEffect(() => {
       if (token) {
           localStorage.removeItem('userObject');
       }
    }, []);

    return (
        <div>
           <Redirect to="/"/>
        </div>
    )
}

export default Logout
