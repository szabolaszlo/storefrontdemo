# https://api-platform.com/docs/core/jwt/#installing-lexikjwtauthenticationbundle
# https://github.com/api-platform/demo/blob/master/api/docker/php/docker-entrypoint.sh
set -e
apt-get update
apt-get install acl -y
apt-get install openssl -y

mkdir -p config/jwt

if [ ! -f ./.env.local ]; then
    echo ".env.local file not found!"
    exit 1
fi

jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' .env.local | cut -f 2 -d ''='')}

echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
