#!/bin/sh

npm config set "strict-ssl" false -g
npm install --loglevel verbose

if grep -q "ENV=local" ../.env; then
    echo "START development NODEJS"
    npm run dev
    #npm run dev -- --host
else
    echo "START production NODEJS"
    npm run build
fi

#sail build --no-cache sail up sail npm run dev

tail -f /dev/null
