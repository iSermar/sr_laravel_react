// Libraries import
import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'

// Import archives
import Header from './Header'
import NewProject from './NewProject'
import ProjectsList from './ProjectsList'
import SingleProject from './SingleProject'

// Render 
class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Header />
          <Switch>
            <Route exact path='/' component={ProjectsList} />
            <Route path='/create' component={NewProject} />
            <Route path='/:id' component={SingleProject} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

// Get id to render in the view
ReactDOM.render(<App />, document.getElementById('app'))
