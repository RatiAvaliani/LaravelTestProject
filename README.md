# How It Works

## Install
### You can run to install DB or use install.sql:
    ` php artisan migrate `


## Using
#### To get tokens you need to register as a user at:
    `
        http://127.0.0.1:8000/register
    `
#### Or login:
        `
            http://127.0.0.1:8000/login
        `
        
#### Or use dashboard:
        `
            http://127.0.0.1:8000
        `

##### Validation is not set so you can use dummy data.

### Using: Generate New Token Link you  can create tokens (This is not using api)
#### after this you will see tables fill in.
#### under the Access Token you can copy the token
#### using the big X button you can remove tokens (This is not using api)

#### On the second table you can see your requestLogs and counter

## Using the api 
### Api has only tow function create to remove tokens
### You can do this by calling by get as Described

#### To create call
`
    http://127.0.0.1:8000/api/me/create?access_token=[token_here]
`
#### To remove call
`
    http://127.0.0.1:8000/api/me/remove/45?access_token=[token_here]
`

### Or post (Bearer Token)
#### To create call

`
    url: http://127.0.0.1:8000/api/me/create
    
    header: [
         Authorization: "Bearer [token_here]"    
    ]
`
#### To remove call

`
    url: http://127.0.0.1:8000/api/me/remove/45
    
    header: [
         Authorization: "Bearer [token_here]"    
    ]
`

## All Tokens are sot for 30 Days and Will be removed automatically by command: removeOldTokens:cron