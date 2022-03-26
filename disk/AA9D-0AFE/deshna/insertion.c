#include<stdio.h>
#include<time.h>
void main()
{
int a[1000000],i,j,temp;
int n=100000;
time_t seconds;
seconds=time(NULL);
printf("timestamp:%ld\n",seconds);
printf("enter elements");
for(i=0;i<n;i++)
{
a[i]=rand();
}
for(i=1;i<=n;i++)
{
j=i;
while(j>0 && a[j-1] >a[j])
{
temp=a[j];
a[j]=a[j-1];
a[j-1]=temp;
j--;
}
}
printf("sorted array:\n");
for(i=0;i<n;i++)
{
 //printf("%d\t",a[i]);
}
seconds=time(NULL);
printf("timestamp:%ld\n",seconds);
}




