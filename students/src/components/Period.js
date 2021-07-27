import React, {useEffect, useState} from 'react'
import Header from './Header'
import {Redirect} from 'react-router-dom';

const Period = () => {

    const [runRe, setRunRe] = useState(false);

    const [name, setName] = useState('');


    const [showCreateOrNot, setShowCreateOrNot] = useState(true);

    //const [showForUpdate, setshowForUpdate] = useState(false);

    const [studentOrNot, setStudentOrNot] = useState();

    const getUserPeriod = async(userToken) => {

        const {token} = userToken;

        const http = await fetch(`http://127.0.0.1:8000/api/teacher/period/single/${token}`);
        const datas = await http.json();

        const {status, periodDetails} = datas;

        if (status) {
            let { id, name, user_id } = periodDetails;
            setName(name);

            return;
        }

        console.log(datas)

        setShowCreateOrNot(false);

       // setName(periodDetails)


    }


    useEffect(() => {
       
        let  token = JSON.parse(localStorage.getItem("userObject"));

        if (token == null) {
            setRunRe(true);
        }else{
            setStudentOrNot(token.role);

            getUserPeriod(token);

         
        }

    }, []);


    const vreatePeriod = async (e) => {
        e.preventDefault();

        let  userToken = JSON.parse(localStorage.getItem("userObject"));

        let uSerTokenForUp = userToken.token;

        const data = {
            name: name,
            token: uSerTokenForUp,
        }

        const http = await fetch(`http://127.0.0.1:8000/api/period/create`, {

            method: 'POST', // *GET, POST, PUT, DELETE, etc.
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

          const periodCreation = await http.json();

          const { status, msg } = periodCreation;

          if (status) {
            setShowCreateOrNot(true);
          }
          alert(msg);


        }



        const updatePeriod = (e) => {
            e.preventDefault();

            alert(name)
        }


    
    return (
        <>
            <Header/>
        <div className="container">

        {
            showCreateOrNot == false ? <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Dashboard</div>
                    <div className="card-body">
                    <form>
                            <div className="form-group">
                                <label for="">Create a period</label>
                                <input type="text" className="form-control"
                                 name="name" value={name}  onChange={e => setName(e.target.value)}/>
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Create" onClick={vreatePeriod}/>                   
                        </form>
                    </div>
                </div>
            </div>
        </div> : ''
        }




        
            {/* //for editing

        showCreateOrNot == false ? <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Dashboard</div>
                    <div className="card-body">
                    <form>
                            <div className="form-group">
                                <label for="">Create a period</label>
                                <input type="text" className="form-control"
                                 name="name" value={name}  onChange={e => setName(e.target.value)}/>
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Edit" onClick={updatePeriod}/>                   
                        </form>
                    </div>
                </div>
            </div>
        </div> : ''
        }
     */}




{
    showCreateOrNot ?    <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header"> your period</div>
                    <div className="card-body">
                  

                    <form className="d-flex justify-content-around align-items-center my-2">
                    <div className="form-group">
                    {name}
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Edit" onClick={e => {
                                e.preventDefault();

                            }}/>                   
                        </form>

                  

                    </div>
                </div>
            </div>
        </div> : ''
}

     


        <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Dashboard</div>
                    <div className="card-body">
                    <form className="d-flex justify-content-around align-items-center my-2">
                    <div className="form-group">
                       Math
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Join to teach" onClick={vreatePeriod}/>                   
                        </form>



                        <form className="d-flex justify-content-around align-items-center my-2">
                    <div className="form-group">
                       Math
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Join to teach" onClick={vreatePeriod}/>                   
                        </form>


                        <form className="d-flex justify-content-around align-items-center my-2">
                    <div className="form-group">
                       Math
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Join to teach" onClick={vreatePeriod}/>                   
                        </form>


                        <form className="d-flex justify-content-around align-items-center my-2">
                    <div className="form-group">
                       Math
                            </div>            
                            <input type="submit" className="btn btn-primary" value="Join to teach" onClick={vreatePeriod}/>                   
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
        studentOrNot == 0 ? <Redirect to="/student/profile"/> : ''
    }
    </>
    )
}

export default Period;
