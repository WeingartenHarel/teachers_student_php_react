import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

ReactDOM.render(<App />, document.getElementById('root'));

class App extends Component {
  render() {
    return (
      <div>
        App
      </div>
    );
  }
}

export default App;