

# StripMarkDown

1- stripo login command [link](https://github.com/stripo/stripo-cli)

A- Download Stripe CLI manually  
```bash
wget https://github.com/stripe/stripe-cli/releases/latest/download/stripe_1.27.0_linux_x86_64.tar.gz
```

B- Extract the archive  
```bash
tar -xzf stripe_1.27.0_linux_x86_64.tar.gz
```

C- Move the binary to a directory in PATH  
```bash
sudo mv stripe /usr/local/bin/
```

D- Verify installation  
```bash
stripe --version
```

E- Run the command  
```bash
stripe login
```


